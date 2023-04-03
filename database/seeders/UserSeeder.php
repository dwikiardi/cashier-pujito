<?php

namespace Database\Seeders;

use App\Models\Pengurus;
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
        // DB::table('users')->delete();
        $role = Role::pluck('id')->toArray();
        $email = ['gembala@gmail.com', 'sekretaris@gmail.com', 'bendahara@gmail.com'];
        $name = ['Gembala', 'Sekretaris', 'Bendahara'];
        $birthday = [
            '1970/09/15', '1980/12/20', '1981/12/21'
        ];
        DB::transaction(function () use($role, $email, $name, $birthday){
            for($i = 0; $i < count($role)-1; $i++) {
                $user = User::create([
                    'email' => $email[$i],
                    'password' => bcrypt('12345678'),
                    'role_id' => $role[$i],
                    'foto' => 'assets/uploads/media/users/blank.png',
                    'is_active' => true
                ]);

                Pengurus::create([
                    'user_id' => $user->id,
                    'nama' => $name[$i],
                    'tempat_lahir' => 'Denpasar',
                    'tanggal_lahir' => $birthday[$i],
                    'jenis_kelamin' => TRUE,
                    'telp' => '082237188923',
                    'alamat' => 'Jl. Palapa XIV Gg. Ikan Sardin No.9, Sesetan - Denpasar Selatan',
                ]);
            }
        });
    }
}
