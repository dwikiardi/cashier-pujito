<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index');
    }

    public function render()
    {
        $customers = Customer::all();
        $view = [
            'data' => view('customers.render', compact('customers'))->render()
        ];

        return response()->json($view);
    }

    public function store(CustomerRequest $request)
    {
        if ($request->ajax()) {
            try {
                // variables
                $name = $request->name;
                $phone = $request->phone;
                $address = $request->address;
                $image = $request->file('image');

                $data = [
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                ];
                
                // upload image
                if($request->has('image')){
                    $imageName = 'Profil-' . $name . '-' . time() . '.' . $image->getClientOriginalExtension();
                    $path = 'assets/uploads/media/users';
                    $image->move(public_path($path), $imageName);
                    $data += [
                        'image' => $path . '/' . $imageName
                    ];
                }
                // save to customer table
                Customer::create($data);

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

    public function edit($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        return response()->json($customer);
    }

    public function update(CustomerRequest $request)
    {
        try {
            $name = $request->name;
            $phone = $request->phone;
            $address = $request->address;
            $customer_id = $request->customer_id;

            // to get user id on selected customer
            $customer = Customer::findOrFail($customer_id);
            
            // update data customer
            $customer->update([
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
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

    public function updateStatus(Request $request)
    {
        $customer_id = $request->customer_id;
        $status = $request->status;
        if($request->ajax()){
            try {
                // update data
                $customer_id = Customer::findOrFail($customer_id);
                $customer_id->update([
                    'is_active' => $status
                ]);

                // send message to view as json
                return response()->json([
                    'status' => 'success',
                    'message' => 'Status berhasil diperbarui',
                    'title' => 'Berhasil'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Status gagal diperbarui',
                    'title' => 'Gagal'
                ]);
            }
        } else {
            return "Access Denied";
        }
    }

    public function delete(Request $request)
    {
        try {
            $customer = Customer::findOrFail($request->customer_id);

            // unlink image before delete
            if($customer->image != 'assets/uploads/media/users/blank.png'){
                unlink($customer->image);
            }

            // delete
            $customer->delete();
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
