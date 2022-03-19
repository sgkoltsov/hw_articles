<!-- Если $comments существует, то существует, если нет, то создаем новую пустую коллекцию -->
@php
    $comments = $comments ?? collect();
@endphp

@if($comments->isNotEmpty())
    
    <div class="col-md-8">
        <h3 class="pb-4 mb-0 fst-italic border-bottom">
            Комментарии
        </h3>      

        <table class="table">
            <thead>                
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Comment</th>
                    <th scope="col">User</th>
                    <th scope="col">Create at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $key => $comment)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $comment->body }}</td>
                        <td>{{ $comment->owner()->name }}</td>
                        <td>{{  $comment->created_at->toFormattedDateString() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>       
@endif