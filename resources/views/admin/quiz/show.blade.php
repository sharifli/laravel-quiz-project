<x-app-layout>
    <x-slot name="header">{{ $quiz->title }}</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-secondary">Back to quizzes <i class="fa fa-arrow-left"></i></a>
            </h5>
            <p class="card-text">
                <div class="row">
                    <div class="col-md-4">
                    <ul class="list-group">
                        @if($quiz->my_rank)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Your rank
                            <span class="badge alert-success badge-pill">{{ $quiz->my_rank }}</span>
                        </li>
                        @endif
                        @if($quiz->my_result)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Your point
                            <span class="badge alert-success badge-pill">{{ $quiz->my_result->point }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Correct / Incorrect
                            <span class="badge alert-warning badge-pill">{{ $quiz->my_result->correct.' / '.$quiz->my_result->incorrect }}</span>
                        </li>
                        @endif
                        @if($quiz->finished_at)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Finish date
                            <span title="{{ $quiz->finished_at }}" class="badge alert-primary badge-pill">{{ $quiz->finished_at->diffForHumans() }}</span>
                        </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Questions
                            <span class="badge alert-primary badge-pill">{{ $quiz->questions_count }}</span>
                        </li>
                        @if($quiz->details)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            User count
                            <span class="badge alert-secondary badge-pill">{{ $quiz->details['user_count'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Average point
                            <span class="badge alert-light badge-pill">{{ $quiz->details['average'] }}</span>
                        </li>
                        @endif
                        
                    </ul>
                    @if(count($quiz->top_ten) > 0)
                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Top 10</h5>
                            <ul class="list-group">
                                @foreach($quiz->top_ten as $ten)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>{{ $loop->iteration }}.</strong>
                                    <span @if(auth()->user()->id == $ten->user_id) class="text-danger" @endif>{{ $ten->user->name.' : '.$ten->point }}</span>
                                    <img src="{{ asset($ten->user->profile_photo_url) }}" style="height: 50px; width:50px;" class="img-responsive rounded-full">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    </div>
                    <div class="col-md-8">
                        <p>{{ $quiz->description }}</p>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Point</th>
                                    <th scope="col">Correct</th>
                                    <th scope="col">Incorrect</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quiz->results as $result)
                                <tr>
                                    <td>{{ $result->user->name }}</td>
                                    <td>{{ $result->point }}</td>
                                    <td>{{ $result->correct }}</td>
                                    <td>{{ $result->incorrect }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </p>
        </div>
    </div>
    
</x-app-layout>
