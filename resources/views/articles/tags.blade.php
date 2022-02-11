<!-- Если $tags существует, то существует, если нет, то создаем новую пустую коллекцию -->
@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href="/articles/tags/{{ $tag->getRouteKey() }}" class="badge rounded-pill bg-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif