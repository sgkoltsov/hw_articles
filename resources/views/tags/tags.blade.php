<!-- Если $tags существует, то существует, если нет, то создаем новую пустую коллекцию -->
@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href="/tags/{{ $tag->getRouteKey() }}" class="badge bg-warning text-dark">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif