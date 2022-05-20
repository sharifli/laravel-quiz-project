<x-app-layout>
    <x-slot name="header">{{ $quiz->title }}</x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quiz.result', $quiz->slug) }}" method="POST">
            @csrf
            @foreach($quiz->questions as $question)
                <strong>{{ $loop->iteration.'. '.$question->question }}</strong>
                @if($question->image)
                    <img src="{{ asset($question->image) }}" class="img-responsive">
                @endif
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $question->answer1 }}" value="answer1" checked>
                    <label class="form-check-label" for="{{ $question->answer1 }}">
                        {{ $question->answer1 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $question->answer2 }}" value="answer2">
                    <label class="form-check-label" for="{{ $question->answer2 }}">
                        {{ $question->answer2 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $question->answer3 }}" value="answer3">
                    <label class="form-check-label" for="{{ $question->answer3 }}">
                        {{ $question->answer3 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $question->answer4 }}" value="answer4">
                    <label class="form-check-label" for="{{ $question->answer4 }}">
                        {{ $question->answer4 }}
                    </label>
                </div>
                <hr>
            @endforeach
            <center><button type="submit" class="btn btn-success btn-block mt-2">Finish quiz</button></center>
            </form>
            
        </div>
    </div>
</x-app-layout>
