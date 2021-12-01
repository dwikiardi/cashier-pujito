<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        return view('admins.communities.index');
    }

    public function render()
    {
        $communities = Community::with('user')->get();

        $view = [
            'data' => view('admins.communities.render', compact('communities'))->render()
        ];

        return response()->json($view);
    }

    public function changeStatus(Request $request)
    {
        $community = Community::find($request->id);
        try {
            $community->update([
                'status' => $request->status
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
}
