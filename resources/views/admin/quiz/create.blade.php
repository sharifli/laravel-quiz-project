<x-app-layout>
    <x-slot name="header">Create quiz</x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Quiz title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label>Quiz description</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="is_finished" @if(old('finished_at')) checked @endif>
                    <label>Is finish date exists?</label>
                </div>
                <div class="form-group is_finished_div">
                    <label>Quiz finish date</label>
                    <input type="datetime-local" name="finished_at" class="form-control" value="{{ old('finished_at') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Save</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            @if(!old('finished_at'))
                $('.is_finished_div').hide();
            @endif
            $('#is_finished').change(function(){
                if($('#is_finished').is(':checked')){
                    $('.is_finished_div').show();
                }else{
                    $('.is_finished_div').hide();
                }
                
            });
        </script>
    </x-slot>
</x-app-layout>