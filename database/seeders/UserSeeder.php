<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $role = Role::where('name', 'Admin')->firstOrFail();
        DB::transaction(function () use($role){
            $user = User::create([
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'role_id' => $role->id,
                'image' => 'assets/uploads/media/users/blank.png'
            ]);

            Admin::create([
                'user_id' => $user->id,
                'name' => 'Administrator',
                'place_of_birth' => 'Denpasar',
                'date_of_birth' => '1998/12/15',
                'gender' => TRUE,
                'phone' => '082237188923',
                'address' => 'Jl. Palapa XIV Gg. Ikan Sardin No.9, Sesetan - Denpasar Selatan',
            ]);
        });
    }
}
