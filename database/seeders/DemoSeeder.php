<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surveys = \App\Models\Survey::factory()->count(10)->create();
        $questions = \App\Models\Question::factory()->count(50)->create();

        // randomly attach
        foreach ($surveys as $s) {
            $s->questions()->syncWithoutDetaching($questions->random(rand(5,15))->pluck('id')->all());
        }
    }
}
