<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('task_statuses')->insertOrIgnore([
            ['name' => 'Jauns'],
            ['name' => 'Procesā'],
            ['name' => 'Pabeigts'],
        ]);
    }
}
