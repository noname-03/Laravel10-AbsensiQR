<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::create([
            'class_education_id' => 1,
            'user_id' => 1,
            'day' => 'Senin',
        ]);
        Schedule::create([
            'class_education_id' => 2,
            'user_id' => 2,
            'day' => 'Selasa',
        ]);
        Schedule::create([
            'class_education_id' => 3,
            'user_id' => 3,
            'day' => 'Rabu',
        ]);
        Schedule::create([
            'class_education_id' => 4,
            'user_id' => 1,
            'day' => 'Kamis',
        ]);
    }
}