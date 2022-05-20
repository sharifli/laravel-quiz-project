<x-app-layout>
    <x-slot name="header">Update {{ $question->question }}</x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('questions.update', [$question->quiz_id, $question->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Question</label>
                    <textarea name="question" rows="4" class="form-control">{{ $question->question }}</textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    @if($question->image)
                        <a href="{{ asset($question->image) }}" target="_blank">
                            <img src="{{ asset($question->image) }}" class="img-responsive" style="width:200px">
                        </a>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Answer 1</label>
                            <textarea name="answer1" rows="4" class="form-control">{{ $question->answer1 }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Answer 3</label>
                            <textarea name="answer3" rows="4" class="form-control">{{ $question->answer3 }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Answer 2</label>
                            <textarea name="answer2" rows="4" class="form-control">{{ $question->answer2 }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Answer 4</label>
                            <textarea name="answer4" rows="4" class="form-control">{{ $question->answer4 }}</textarea>
                        </div>
                    </div>
                </div>
        
                <div class="form-group">
                    <label>Correct Answer</label>
                    <select name="correct_answer" class="form-control">
                        <option value="answer1" @if($question->correct_answer == 'answer1') selected @endif>1. Answer</option>
                        <option value="answer2" @if($question->correct_answer == 'answer2') selected @endif>2. Answer</option>
                        <option value="answer3" @if($question->correct_answer == 'answer3') selected @endif>3. Answer</option>
                        <option value="answer4" @if($question->correct_answer == 'answer4') selected @endif>4. Answer</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>