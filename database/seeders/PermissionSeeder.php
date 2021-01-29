<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'CREATE_MARKERS'],
            ['name' => 'CHANGE_ALL_MARKERS'],
            ['name' => 'UPDATE_MARKER'],
            ['name' => 'VIEW_PERSONAL_MARKERS'],
            ['name' => 'DELETE_MARKER']
        ]);
    }
}
