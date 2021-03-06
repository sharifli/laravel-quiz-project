<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Answer;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;
    public function definition()
    {
        return [
            'user_id' => rand(1,5),
            'question_id' => rand(1,50),
            'answer' => 'answer'.rand(1,4),
        ];
    }
}
