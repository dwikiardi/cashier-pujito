<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketSold;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class DashboardController extends Controller
{
    public function index()
    {
        // $sold = TicketSold::query()->leftJoin('tickets', 'ticket_solds.ticket_id', '=', 'tickets.id')
        //                             ->select('tickets.price', 'tickets.title')
        //                             ->selectRaw('sum(tickets.price - (tickets.price * (ticket_solds.discount / 100)) ) as total')
        //                             // ->groupBy('ticket_sold.ticket_id')
        //                             ->groupBy('tickets.id')
        //                             ->whereBetween('ticket_solds.sale_date', ['2021-11' . '-01', '2021-11' . '-31'])
        //                             ->get();

        
        $month = [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];
        return view('dashboard.index', compact('month'));
    }

    public function chart()
    {
        $view = [
            'data' => view('dashboard.chart.ticket')->render()
        ];

        return response()->json($view);
    }

    public function renderChart(Request $request)
    {
        try {
            $date = $request->year . '-' . $request->month;
            $tickets = Ticket::all();
            $sold = TicketSold::query()->leftJoin('tickets', 'ticket_solds.ticket_id', '=', 'tickets.id')
                                    ->select('tickets.price', 'tickets.title')
                                    ->selectRaw('sum(tickets.price - (tickets.price * (ticket_solds.discount / 100)) ) as total')
                                    // ->groupBy('ticket_sold.ticket_id')
                                    ->groupBy('tickets.id')
                                    ->whereBetween('ticket_solds.sale_date', [$date . '-01', $date . '-31'])
                                    ->get();
            $labels = [];
            $netto = [];
            foreach($sold as $key => $value){
                $labels[] = $value->title;
                $netto[] = $value->total;
            }

            $totalTicket = TicketSold::whereBetween('sale_date', [$date . '-01', $date . '-31'])->count();

            $totalIncome = 0;
            $totalDiscount = 0;

            $ticketSold = TicketSold::with('ticket')->whereBetween('sale_date', [$date . '-01', $date . '-31'])->get();

            foreach($ticketSold as $ticketSold) {
                $totalIncome += $ticketSold->ticket->price - ($ticketSold->ticket->price * ($ticketSold->discount/100));
                $totalDiscount += $ticketSold->ticket->price * ($ticketSold->discount/100);
            }
            return response()->json([
                'label' => $labels,
                'netto' => $netto,
                'totalTicket' => $totalTicket,
                'totalIncome' => convertToRupiah($totalIncome),
                'totalDiscount' => convertToRupiah($totalDiscount)
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function export(Request $request)
    {
        $date = $request->year . '-' . $request->month;
        $tickets = TicketSold::whereBetween('sale_date', [$date . '-01', $date . '-31'])->get();

        $view = [
            'data' => view('dashboard.export.print', compact('tickets', 'date'))->render()
        ];

        return response()->json($view);
    }
}

