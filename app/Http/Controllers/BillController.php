<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;

class BillController extends Controller
{
    public function index()
    {
        $month = [
            'Januari', 'Februari', 'Maret', 'April',
            'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'
        ];

        return view('bills.index', compact('month'));
    }

    public function render($month, $year)
    {
        $date = $year.'-'.$month;
        $lastDay = date('t', strtotime('last day of'. $month));
        $bills = Bill::whereBetween('date', [$date.'-01', $date.'-'.$lastDay])->with('customer.customer_bandwidth.package')->get();
        $view = [
            'data' => view('bills.render', compact('bills'))->render()
        ];
        return response()->json($view);
    }

    public function additional($month, $year)
    {
        $date = $year.'-'.$month;
        $bills = Bill::whereBetween('date', [$date.'-01', $date.'-31'])->with('customer')->get();

        $transaction_success = 0;
        foreach ($bills as $bill)
        {
            if($bill->is_paid == true) {
                $transaction_success += $bill->customer->customer_bandwidth->package->price;
            }
        }

        $data = [
            'total_transaction' => count($bills),
            'transaction_success' => 'Rp. ' . number_format($transaction_success),
            'month' => $month,
            'year' => $year,
        ];
        return response()->json($data);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            try {
                // variables
                $month = $request->month;
                $year = $request->year;
                // $date = $year.'-'.$month.'-'.date('d');
                $date = $year.'-'.$month.'-'.'01';

                // get all customer data
                $customers = Customer::all();
                $customerID = [];
                foreach($customers as $cust){
                    $customerID[] = $cust->id;
                }

                $data = [];
                for($i = 0; $i < count($customerID); $i++){
                    $invoice_number = 'INV/00'. rand(100, 9999);
                    $data[] = [
                        'customer_id' => $customerID[$i],
                        'date' => $date,
                        'invoice_number' => $invoice_number,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString()
                    ];
                }

                // cek before save
                $bill = Bill::where('date', $date)->get();
                if($bill->count() >= 1){
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data pada bulan ini sudah ada sebelumnya',
                        'title' => 'Gagal'
                    ]);
                }

                // check customer before save
                if($customers->count() == 0) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Tidak ada data pelanggan, mohon input data pelangan terlebih dahulu',
                        'title' => 'Gagal'
                    ]);
                }

                // save to bill table
                Bill::insert($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil tersimpan',
                    'title' => 'Berhasil'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'title' => 'Gagal'
                ]);
                // return $e->getMessage();
            }
        } else {
            return "Access Denied";
        }
    }

    public function print(Request $request)
    {
        $date = convertDate(date('Y-m-d'), true);
        $bill = Bill::with('customer')->where('id', $request->id)->first();
        $view = [
            'data' => view('bills.print.index', compact('bill', 'date'))->render()
        ];
        return response()->json($view);
    }

    public function printAll(Request $request)
    {
        $date = convertDate(date('Y-m-d'), true);
        $bill = Bill::with('customer')->whereIn('id', $request->bill_id)->get();
        $view = [
            'data' => view('bills.print.print-all', compact('bill', 'date'))->render()
        ];
        return response()->json($view);
    }

    public function validateBill(Request $request)
    {
        try {
            $bill = Bill::findOrFail($request->id)->update([
                'is_paid' => TRUE
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil di validasi',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
