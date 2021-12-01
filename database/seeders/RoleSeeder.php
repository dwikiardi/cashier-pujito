<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $roles = ['Admin', 'Manager', 'Community'];
        
        foreach($roles as $role){
            Role::create([
                'name' => $role
            ]);
        }
    }
}