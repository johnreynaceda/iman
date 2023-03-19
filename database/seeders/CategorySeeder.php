<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'CAMERA']);
        Category::create(['name' => 'PROJECTOR']);
        Category::create(['name' => 'PRINTER']);
        Category::create(['name' => 'COMPUTER']);
        Category::create(['name' => 'LAPTOP']);
        Category::create(['name' => 'RADIO']);
    }
}
