<?php

namespace Database\Seeders;

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
        DB::table('tbl_user')->insert([
            'name' => 'Nguyen Ngoc Trung',
            'email' => 'trungnn160697@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '0396927189',
            'role_id' => 1
        ]);
    }
}
