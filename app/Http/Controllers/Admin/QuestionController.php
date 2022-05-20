<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index($quiz_id)
    {
        $quiz = Quiz::whereId($quiz_id)->with('questions')->first() ?? abort(404, 'Quiz not found');
        return view('admin.question.list', compact('quiz'));
    }

    public function create($quiz_id)
    {

        $quiz = Quiz::find($quiz_id);
        return view('admin.question.create', compact('quiz'));
    }

    public function store(QuestionCreateRequest $request, $quiz_id)
    {
        if($request->hasFile('image')){
            $file_name = Str::slug($request->question).'.'.$request->image->extension();
            $file_fullpath = 'uploads/'.$file_name;

            $request->image->move(public_path('uploads'), $file_name);
            $request->merge([
                'image' => $file_fullpath,
            ]);
        }
        Quiz::find($quiz_id)->questions()->create($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Question successfully created');
    }

    public function show($quiz_id,$question_id)
    {
        return $quiz_id.'//'.$question_id;
    }

    public function edit($quiz_id, $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Question not found');
        return view('admin.question.edit', compact('question'));
    }

    public function update(QuestionUpdateRequest $request, $quiz_id, $question_id)
    {
        if($request->hasFile('image')){
            $file_name = Str::slug($request->question).'.'.$request->image->extension();
            $file_fullpath = 'uploads/'.$file_name;

            $request->image->move(public_path('uploads'), $file_name);
            $request->merge([
                'image' => $file_fullpath,
            ]);
        }
        Quiz::find($quiz_id)->questions()->whereId($question_id)->first()->update($request->post());
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Question successfully updated');
    }

    public function destroy($quiz_id, $question_id)
    {
        $question = Quiz::find($quiz_id)->questions()->whereId($question_id)->first() ?? abort(404, 'Question not found');
        $question->delete();
        return redirect()->route('questions.index', $quiz_id)->withSuccess('Question successfully deleted');
    }
}
