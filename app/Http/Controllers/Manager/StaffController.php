<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index()
    {
        return view('managers.staffs.index');
    }

    public function render()
    {
        $staffs = Admin::with('user')->get();

        $view = [
            'data' => view('managers.staffs.render', compact('staffs'))->render()
        ];

        return response()->json($view);
    }

    public function store(StaffRequest $request)
    {
        if ($request->ajax()) {
            try {
                $role = Role::where('name', 'Admin')->firstOrFail();
                // do all save if success or rollback all if any fail
                DB::transaction(function () use ($request, $role) {
                    // variables
                    $name = $request->name;
                    $place_of_birth = $request->place_of_birth;
                    $date_of_birth = $request->date_of_birth;
                    $gender = $request->gender;
                    $phone = $request->phone;
                    $address = $request->address;
                    $image = $request->file('image');
                    $email = $request->email;
                    $password = $request->password;
                    
                    // upload image
                    $imageName = 'Profil-' . Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
                    $path = 'assets/uploads/media/users';
                    $image->move(public_path($path), $imageName);

                    // save user first
                    $user = User::create([
                        'email' => $email,
                        'password' => bcrypt($password),
                        'role_id' => $role->id,
                        'image' => $path . '/' . $imageName
                    ]);

                    // save to visitor table
                    $Admin = Admin::create([
                        'user_id' => $user->id,
                        'name' => $name,
                        'place_of_birth' => $place_of_birth,
                        'date_of_birth' => $date_of_birth,
                        'gender' => $gender,
                        'phone' => $phone,
                        'address' => $address,
                    ]);
                });
                
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

    public function edit($id)
    {
        $admin = Admin::with('user')->where('id', $id)->firstOrFail();

        return response()->json($admin);
    }

    public function update(StaffRequest $request)
    {
        if ($request->ajax()) {
            try {
                $admin = Admin::find($request->admin_id);
                // do all save if success or rollback all if any fail
                DB::transaction(function () use ($request, $admin) {
                    // variables
                    $name = $request->name;
                    $place_of_birth = $request->place_of_birth;
                    $date_of_birth = $request->date_of_birth;
                    $gender = $request->gender;
                    $phone = $request->phone;
                    $address = $request->address;
                    $image = $request->file('image');
                    $email = $request->email;
                    
                    // update user first
                    $userData = [
                        'email' => $email,
                    ];

                    if($request->has('image')){
                        unlink($admin->image);
                        // upload image
                        $imageName = 'Profil-' . Str::random(10) . '-' . time() . '.' . $image->getClientOriginalExtension();
                        $path = 'assets/media/users/teachers';
                        $image->move(public_path($path), $imageName);
                        
                        $userData += [
                            'image' => $path . '/' . $imageName
                        ];
                    }

                    User::where('id', $admin->user_id)->update($userData);

                    // save to visitor table
                    $admin->update([
                        'name' => $name,
                        'place_of_birth' => $place_of_birth,
                        'date_of_birth' => $date_of_birth,
                        'gender' => $gender,
                        'phone' => $phone,
                        'address' => $address,
                    ]);
                });
                
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

    public function changeStatus(Request $request)
    {
        $admin = Admin::find($request->id);
        try {
            $admin->update([
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
