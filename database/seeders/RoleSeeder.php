<?php

namespace Database\Seeders;

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
        //
        DB::table('tbl_role')->insert(
            [
                [
                    'name' => 'Super Admin',
                    'code' => 'SUPER_ADMIN',
                ],
                [
                    'name' => 'Admin',
                    'code' => 'ADMIN',
                ],
            ]
        );
    }
}
