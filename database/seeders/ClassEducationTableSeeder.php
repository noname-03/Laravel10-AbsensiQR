<?php

namespace Database\Seeders;

use App\Models\ClassEducation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassEducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassEducation::create([
            'title' => 'Kelas 1',
        ]);
        ClassEducation::create([
            'title' => 'Kelas 2',
        ]);
        ClassEducation::create([
            'title' => 'Kelas 3',
        ]);
        ClassEducation::create([
            'title' => 'Kelas 4',
        ]);
    }
}