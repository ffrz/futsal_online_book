<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Field::truncate();
        Schema::enableForeignKeyConstraints();
        
        DB::table('fields')->insert([
            'name' => 'Lapangan 1',
            'cover' => '1-1.jpg',
        ]);
        DB::table('fields')->insert([
            'name' => 'Lapangan 2',
            'cover' => '2-1.jpg',
        ]);
    }
}
