<!-- Если $comments существует, то существует, если нет, то создаем новую пустую коллекцию -->
@php
    $comments = $comments ?? collect();
@endphp

@if($comments->isNotEmpty())
    
    <div class="col-md-8">
        <h3 class="pb-4 mb-0 fst-italic">
            Комментарии к статье
        </h3>

        @foreach($comments as $key => $comment)

            <div class="alert alert-info mb-0" role="alert">
                {{ $comment->body }}
            </div>
            <p class="mb-0">User: {{ $comment->owner()->name }}</p>
            <p>Date: {{  $comment->created_at->toFormattedDateString() }}</p>

            <hr>
            
        @endforeach
          
    </div>       
@endif