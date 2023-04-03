<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'role' => 'admin'             
        ]);

        DB::table('role')->insert([
            'role' => 'user'   
           
        ]);
    }
}
