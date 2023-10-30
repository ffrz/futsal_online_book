<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('user_groups')->truncate();
        Schema::enableForeignKeyConstraints();

        $names = ['Super Administrator', 'Administrator', 'Power User', 'User'];
        foreach ($names as $i => $name) {
            DB::table('user_groups')->insert([
                'id' => $i+1,
                'name' => $name,
            ]);
        }
    }
}
