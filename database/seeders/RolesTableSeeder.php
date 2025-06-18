<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['name' => 'admin'],
            ['name' => 'user'],
            ['name' => 'guest'],
        ]);
    }
}
