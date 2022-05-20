<x-app-layout>
    <x-slot name="header">Quizzes</x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{ route('quizzes.create') }}" class="btn btn-sm btn-primary">Create quiz <i class="fa fa-plus"></i></a>
            </h5>
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" name="title" value="{{ request()->title }}" class="form-control" placeholder="Quiz name">
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Select status</option>
                            <option value="published" @if(request()->status == 'published') selected @endif>Published</option>
                            <option value="passive" @if(request()->status == 'passive') selected @endif>Passive</option>
                            <option value="draft" @if(request()->status == 'draft') selected @endif>Draft</option>
                        </select>
                    </div>
                    @if(request()->get('title') || request()->get('status'))
                        <div class="col-md-2">
                            <a href="{{ route('quizzes.index') }}" class="btn btn0sm btn-secondary">Reset</a>
                        </div>
                    @endif
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Quiz</th>
                        <th scope="col">Questions</th>
                        <th scope="col">Status</th>
                        <th scope="col">Finished at</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $quiz)
                    <tr>
                        <td scope="row">{{ $quiz->title }}</td>
                        <td>{{ $quiz->questions_count }}</td>
                        <td>
                            @switch($quiz->status)
                                @case('published')
                                    @if(!$quiz->finished_at)
                                        <a class="btn btn-sm btn-success">Published</a>
                                    @elseif($quiz->finished_at > now())
                                        <a class="btn btn-sm btn-success">Published</a>
                                    @else
                                        <a class="btn btn-sm btn-secondary">Expired</a>
                                    @endif
                                    @break
                                @case('passive')
                                    <a class="btn btn-sm btn-danger">Passive</a>
                                    @break
                                @case('draft')
                                    <a class="btn btn-sm btn-warning">Draft</a>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <span title="{{ $quiz->finished_at }}">
                            {{ $quiz->finished_at ? $quiz->finished_at->diffForHumans() : '-' }}
                            </span>
                        </td>
                        <td>
                        <a href="{{ route('quizzes.details', $quiz->id) }}" class="btn btn-sm btn-secondary"><i class="fa fa-info-circle"></i></a>
                            <a href="{{ route('questions.index', $quiz->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-question"></i></a>
                            <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <a href="{{ route('quizzes.destroy', $quiz->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $quizzes->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
