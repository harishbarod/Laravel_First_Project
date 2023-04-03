<?php

namespace Database\Seeders;
use DB;

use Illuminate\Database\Seeder;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'age'  => '30',
           'role_id' =>1,
           'mobile'  =>8669171651,
           'password' => password_hash('12345678', PASSWORD_DEFAULT )
      
        ]);
    }
}
