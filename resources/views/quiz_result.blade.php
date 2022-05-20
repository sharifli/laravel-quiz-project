<x-app-layout>
    <x-slot name="header">{{ $quiz->title }} result</x-slot>
    <div class="card">
        <div class="card-body">
            <h3>Your point : <strong>{{ $quiz->my_result->point }}</strong></h3>
            @foreach($quiz->questions as $question)

                @if($question->correct_answer == $question->my_answer->answer)
                    <i class="fa fa-check text-success"></i>
                @else
                    <i class="fa fa-times text-danger"></i>
                @endif
                <small><strong>{{ $question->true_percent }}%</strong> of users answers correct</small><br>
                <strong>{{ $loop->iteration.'. '.$question->question }}</strong>
                @if($question->image)
                    <img src="{{ asset($question->image) }}" class="img-responsive">
                @endif
                <div class="form-check mt-2">
                    <input class="form-check-input" disabled type="radio" name="{{ $question->id }}" id="{{ $question->answer1 }}" value="answer1" @if($question->my_answer->answer=='answer1') checked @endif>
                    <label class="form-check-label" for="{{ $question->answer1 }}">
                        {{ $question->answer1 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" disabled type="radio" name="{{ $question->id }}" id="{{ $question->answer2 }}" value="answer2" @if($question->my_answer->answer=='answer2') checked @endif>
                    <label class="form-check-label" for="{{ $question->answer2 }}">
                        {{ $question->answer2 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" disabled type="radio" name="{{ $question->id }}" id="{{ $question->answer3 }}" value="answer3" @if($question->my_answer->answer=='answer3') checked @endif>
                    <label class="form-check-label" for="{{ $question->answer3 }}">
                        {{ $question->answer3 }}
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" disabled type="radio" name="{{ $question->id }}" id="{{ $question->answer4 }}" value="answer4" @if($question->my_answer->answer=='answer4') checked @endif>
                    <label class="form-check-label" for="{{ $question->answer4 }}">
                        {{ $question->answer4 }}
                    </label>
                </div>
                @if(!$loop->last)<hr>@endif
            @endforeach            
        </div>
    </div>
</x-app-layout>
