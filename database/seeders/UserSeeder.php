<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('users')->insert([
            'name' => 'Fahmi Fauzi Rahman',
            'email' => 'fahmifauzirahman@gmail.com',
            'group_id' => 1,
            'password' => Hash::make('12345'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dzaki Dhafir',
            'email' => 'dzakidhafirrahman@gmail.com',
            'group_id' => 3,
            'password' => Hash::make('12345'),
        ]);

        User::factory(100)->create();
    }
}
