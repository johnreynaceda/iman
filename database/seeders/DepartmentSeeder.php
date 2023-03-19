<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Department of Admin and Finance',
        ]);

        Department::create([
            'name' => 'Department of Programs',
        ]);

        Department::create([
            'name' => 'Department of Management',
        ]);
    }
}
