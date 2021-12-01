<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $role = Role::where('name', 'Manager')->firstOrFail();
        DB::transaction(function () use($role){
            $user = User::create([
                'email' => 'manager@gmail.com',
                'password' => bcrypt('12345678'),
                'role_id' => $role->id,
                'image' => 'assets/uploads/media/users/blank.png'
            ]);

            Manager::create([
                'user_id' => $user->id,
                'name' => 'Manager',
                'place_of_birth' => 'Denpasar',
                'date_of_birth' => '1996/09/12',
                'gender' => TRUE,
                'phone' => '082237188923',
                'address' => 'Desa Ceking Tegallalang',
            ]);
        });
    }
}
