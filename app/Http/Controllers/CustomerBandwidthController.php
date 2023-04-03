<?php

namespace App\Http\Controllers;

use App\Http\Requests\BandwidthRequest;
use App\Models\Customer;
use App\Models\CustomerBandwidth;
use App\Models\Package;
use Illuminate\Http\Request;

class CustomerBandwidthController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $packages = Package::all();
        return view('bandwidths.index', compact('customers', 'packages'));
    }

    public function render()
    {
        $bandwidths = CustomerBandwidth::with('customer')->get();
        $view = [
            'data' => view('bandwidths.render', compact('bandwidths'))->render()
        ];

        return response()->json($view);
    }

    public function store(BandwidthRequest $request)
    {
        if ($request->ajax()) {
            try {
                // variables
                $ip_radio = $request->ip_radio;
                $ip_access = $request->ip_access;
                $package_id = $request->package_id;
                $customer_id = $request->customer_id;

                $data = [
                    'ip_radio' => $ip_radio,
                    'ip_access' => $ip_access,
                    'package_id' => $package_id,
                    'customer_id' => $customer_id,
                ];
                
                // find data before saving
                $customerBandwidth = CustomerBandwidth::where('customer_id', $customer_id)->first();
                if($customerBandwidth) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data ' .$customerBandwidth->customer->name. ' sudah tersimpan',
                        'title' => 'Gagal'
                    ]);
                }
                
                // save to customer table
                CustomerBandwidth::create($data);
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

    public function edit($bandwidth_id)
    {
        $bandwidth = CustomerBandwidth::with('customer', 'package')->findOrFail($bandwidth_id);
        return response()->json($bandwidth);
    }

    public function update(BandwidthRequest $request)
    {
        try {
            $ip_radio = $request->ip_radio;
            $ip_access = $request->ip_access;
            $package_id = $request->package_id;
            $bandwidth_id = $request->bandwidth_id;
            $customer_id = $request->customer_id;

            // to get customer id on selected bandwidth
            $bandwidth = CustomerBandwidth::findOrFail($bandwidth_id);
            
            // update data bandwidth
            $bandwidth->update([
                'ip_radio' => $ip_radio,
                'ip_access' => $ip_access,
                'package_id' => $package_id,
                'customer_id' => $customer_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diubah',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try {
            $bandwidth = CustomerBandwidth::findOrFail($request->bandwidth_id);

            // delete
            $bandwidth->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil terhapus',
                'title' => 'Berhasil'
            ]);
            // return response()->json('Data berhasil dihapus');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
            // return response()->json($e->getMessage());
        }
    }
}
