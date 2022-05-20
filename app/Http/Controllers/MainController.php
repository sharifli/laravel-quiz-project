<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;

class MainController extends Controller
{
    public function dashboard(){
        $quizzes = Quiz::where('status', 'published')->where(function($query){
            $query->whereNull('finished_at')->orWhere('finished_at', '>', now());
        })->withCount('questions')->paginate(5);
        $results = auth()->user()->results;
        return view('dashboard', compact('quizzes','results'));
    }

    public function quiz_detail($slug){
        $quiz = Quiz::whereSlug($slug)->with('my_result','results','top_ten.user')->withCount('questions')->first() ?? abort(404, 'Quiz not found');
        return view('quiz_detail', compact('quiz'));
    }

    public function quiz($slug){
        $quiz = Quiz::whereSlug($slug)->with('questions.my_answer')->first() ?? abort(404, 'Quiz not found');
        if($quiz->my_result){
            return view('quiz_result', compact('quiz'));
        }
        return view('quiz', compact('quiz'));
    }

    public function result(Request $request, $slug){
        $quiz = Quiz::whereSlug($slug)->with('questions')->first() ?? abort(404, 'Quiz not found');
        $answers = $request->post();
        $correct = 0;
        if($quiz->my_result){
            abort(404, 'Already finished this quiz');
        }
        foreach($quiz->questions as $question){
            Answer::create([
                'user_id' => auth()->user()->id,
                'question_id' => $question->id,
                'answer' => $request->post($question->id),
            ]);
            if($question->correct_answer === $request->post($question->id)){
                $correct += 1;
            }
        }

        $point = round((100 / count($quiz->questions)) * $correct);
        $incorrect = count($quiz->questions) - $correct;
        Result::create([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->id,
            'point' => $point,
            'correct' => $correct,
            'incorrect' => $incorrect,
        ]);

        return redirect()->route('quiz.detail', $slug)->withSuccess('You completed the quiz.Your point is '.$point);
    }
}
