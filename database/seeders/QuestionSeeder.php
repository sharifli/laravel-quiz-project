<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        \App\Models\Question::factory(50)->create();
    }
}
