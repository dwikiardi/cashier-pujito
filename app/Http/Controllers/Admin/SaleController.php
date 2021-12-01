<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Models\Ticket;
use App\Models\TicketSold;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        $ticketPrice = Ticket::first();
        return view('admins.tickets-sold.index', compact('tickets', 'ticketPrice'));
    }

    public function render()
    {
        $sold = TicketSold::with('soldBy')->get();

        $view = [
            'data' => view('admins.tickets-sold.render', compact('sold'))->render()
        ];

        return response()->json($view);
    }

    public function store(SaleRequest $request)
    {
        try {
            for($i = 0; $i < $request->total; $i++) {
                TicketSold::create([
                    'admin_id' => auth()->user()->admin->id,
                    'ticket_id' => $request->ticket_id,
                    'sale_date' => $request->sale_date,
                    'discount' => $request->discount
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal tersimpan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $ticketSold = TicketSold::with('ticket')->where('id', $id)->first();
        return response()->json($ticketSold);
    }

    public function update(SaleRequest $request)
    {
        try {
            $ticketSold = TicketSold::find($request->sale_id);
            $ticketSold->update([
                'admin_id' => auth()->user()->admin->id,
                'ticket_id' => $request->edit_ticket_id,
                'sale_date' => $request->sale_date,
                'discount' => $request->discount
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal diubah',
                'title' => 'Gagal'
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $sale = TicketSold::find($request->id);
            $sale->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil terhapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data gagal terhapus',
                'title' => 'Gagal'
            ]);
        }
    }

    public function ticketPrice($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        return response()->json($ticket);
    }
}
