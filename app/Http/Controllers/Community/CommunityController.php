<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityRequest;
use App\Models\Community;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommunityController extends Controller
{
    public function register(CommunityRequest $request)
    {
        if ($request->ajax()) {
            try {
                $role = Role::where('name', 'Community')->firstOrFail();
                // do all save if success or rollback all if any fail
                DB::transaction(function () use ($request, $role) {
                    // variables
                    $name = $request->name;
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
                    $community = Community::create([
                        'user_id' => $user->id,
                        'name' => $name,
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
}
