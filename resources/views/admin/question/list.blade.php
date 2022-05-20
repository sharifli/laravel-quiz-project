<x-app-layout>
    <x-slot name="header">Questions of quiz : {{ $quiz->title }}</x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-secondary">Back to quizzes <i class="fa fa-arrow-left"></i></a>
                <a href="{{ route('questions.create', $quiz->id) }}" class="btn btn-sm btn-primary">Create question <i class="fa fa-plus"></i></a>
            </h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Image</th>
                    <th scope="col">1.Answer</th>
                    <th scope="col">2.Answer</th>
                    <th scope="col">3.Answer</th>
                    <th scope="col">4.Answer</th>
                    <th scope="col">Correct Answer</th>
                    <th scope="col" style="width:100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quiz->questions as $question)
                    <tr>
                        <td scope="row">{{ $question->question }}</td>
                        <td>
                            @if($question->image)
                                <a href="{{ asset($question->image) }}" target="_blank" class="btn btn-sm btn-light">Show</a>
                            @endif
                        </td>
                        <td>{{ $question->answer1 }}</td>
                        <td>{{ $question->answer2 }}</td>
                        <td>{{ $question->answer3 }}</td>
                        <td>{{ $question->answer4 }}</td>
                        <td>{{ substr($question->correct_answer,-1).'. Answer' }}</td>
                        <td>
                            <a href="{{ route('questions.edit', [$quiz->id, $question->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('questions.destroy', [$quiz->id, $question->id]) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</x-app-layout>
