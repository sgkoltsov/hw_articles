@if (auth()->check())
    <h4 class="pb-0 mb-4 fst-italic">
        Добавить комментарий...  
    </h4>

    <form method="post" action="/comments">

        @csrf               

        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="commentable_id" value="{{ $model->id }}">
        <input type="hidden" name="commentable_type" value="{{ $model::class }}">
        
        <div class="mb-3">
            <textarea class="form-control" name="body" style="min-height: 50px;"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 150px;">Сохранить</button>
    </form> 

    <hr>
@endif