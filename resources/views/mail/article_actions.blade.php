@component('mail::message')
<b>Событие:</b> 
<h1>{{ $typeOfActionWithArticle }}</h1>

<b>Пользователь:</b> {{ $article->owner->name }} (e-mail: {{ $article->owner->email }}) <br>
<b>Название статьи:</b> {{ $article->title }}<br>
<b>Краткое описание:</b> {{ $article->short }}<br>
<b>Полное содержание:</b> {{ $article->body }}

@if(! $deleteArticle)
@component('mail::button', ['url' => route('article.show', ['article' => $article->getRouteKey()])])
Посмотреть статью
@endcomponent
@endif

Всегда ваш,<br>
{{ config('app.name') }}
@endcomponent
