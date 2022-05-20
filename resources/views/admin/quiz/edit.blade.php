<x-app-layout>
    <x-slot name="header">Create quiz</x-slot>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Quiz title</label>
                    <input type="text" name="title" class="form-control" value="{{ $quiz->title }}">
                </div>
                <div class="form-group">
                    <label>Quiz description</label>
                    <textarea name="description" rows="4" class="form-control">{{ $quiz->description }}</textarea>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="is_finished" @if($quiz->finished_at) checked @endif>
                    <label>Is finish date exists?</label>
                </div>
                <div class="form-group">
                    <label>Quiz status</label>
                    <select name="status" class="form-control">
                        <option value="published" @if($quiz->questions_count < 4) disabled @endif @if($quiz->status=='published') selected @endif>Published</option>
                        <option value="passive" @if($quiz->status=='passive') selected @endif>Passive</option>
                        <option value="draft" @if($quiz->status=='draft') selected @endif>Draft</option>
                    </select>
                </div>
                <div class="form-group is_finished_div">
                    <label>Quiz finish date</label>
                    <input type="datetime-local" name="finished_at" class="form-control" @if($quiz->finished_at) value="{{ date('Y-m-d\TH:i', strtotime($quiz->finished_at)) }}" @endif>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-sm btn-block">Save</button>
                </div>
            </form>
        </div>
    </div>
    <x-slot name="js">
        <script>
            @if(!$quiz->finished_at)
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