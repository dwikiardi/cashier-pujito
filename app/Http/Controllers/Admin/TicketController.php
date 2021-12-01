<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return view('admins.tickets.index');
    }

    public function render()
    {
        $tickets = Ticket::all();

        $view = [
            'data' => view('admins.tickets.render', compact('tickets'))->render()
        ];

        return response()->json($view);
    }

    public function store(TicketRequest $request)
    {
        try {
            $price = str_replace( array( '\'', '.',
                ' ' , 'Rp'), '', $request->price);
            Ticket::create([
                'title' => $request->title,
                'price' => $price,
                'description' => $request->description
            ]);

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
        $ticket = Ticket::find($id);
        return response()->json($ticket);
    }

    public function update(TicketRequest $request)
    {
        try {
            $price = str_replace( array( '\'', '.',
                ' ' , 'Rp'), '', $request->price);
            $ticket = Ticket::find($request->ticket_id);
            $ticket->update([
                'title' => $request->title,
                'price' => $price,
                'description' => $request->description
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
            $ticket = Ticket::find($request->id);
            $ticket->delete();
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
}
