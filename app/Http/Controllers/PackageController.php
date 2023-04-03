<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        return view('packages.index');
    }

    public function render()
    {
        $packages = Package::all();
        $view = [
            'data' => view('packages.render', compact('packages'))->render()
        ];

        return response()->json($view);
    }

    public function store(PackageRequest $request)
    {
        if ($request->ajax()) {
            try {
                // variables
                $price = $request->price;
                $bandwidth = $request->bandwidth;

                $data = [
                    'bandwidth' => $bandwidth,
                    'price' => $price,
                ];
                
                // save to customer table
                Package::create($data);

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

    public function edit($package_id)
    {
        $package = Package::findOrFail($package_id);
        return response()->json($package);
    }

    public function update(PackageRequest $request)
    {
        try {
            $price = $request->price;
            $bandwidth = $request->bandwidth;
            $package_id = $request->package_id;

            // to get user id on selected bandwidth
            $package = Package::findOrFail($package_id);
            
            // update data bandwidth
            $package->update([
                'price' => $price,
                'bandwidth' => $bandwidth
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
            $package = Package::findOrFail($request->package_id);

            // delete
            $package->delete();
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
