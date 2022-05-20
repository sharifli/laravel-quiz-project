<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuizCreateRequest;
use App\Http\Requests\QuizUpdateRequest;

class QuizController extends Controller
{
    public function index()
    {   
        $quizzes = Quiz::withCount('questions');
        if(request()->get('title')){
            $quizzes = $quizzes->where('title', 'LIKE', '%'.request()->get('title').'%');
        }
        if(request()->get('status')){
            $quizzes = $quizzes->where('status', request()->get('status'));
        }
        $quizzes = $quizzes->paginate(5);
        
        return view('admin.quiz.list', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(QuizCreateRequest $request)
    {
        Quiz::create($request->post());
        return redirect()->route('quizzes.index')->withSuccess('Quiz successfully created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $quiz = Quiz::withCount('questions')->find($id) ?? abort(404, 'Quiz not found');
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(QuizUpdateRequest $request, $id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz not found');
        Quiz::find($id)->update($request->except(['_method', '_token']));
        return redirect()->route('quizzes.index')->withSuccess('Quiz successfully updated');
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id) ?? abort(404, 'Quiz not found');
        $quiz->delete();
        return redirect()->route('quizzes.index');
    }
}
