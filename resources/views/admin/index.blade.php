@extends('layout.master_without_sidebar')

@section('content')	

    <div class="col-md-8">
        <h3 class="pb-4 mb-0 fst-italic border-bottom">
            Список статей
        </h3>      

        <table class="table">
            <thead>                
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Title</th>
                    <!-- <th scope="col">Short Description</th> -->
                    <!-- <th scope="col">Tags</th> -->
                    <th scope="col">Create at</th>
                    <!-- <th scope="col">Update at</th> -->
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article) 
                    <tr>
                        <th scope="row">{{ $article->id }}</th>
                        <td>{{ $article->owner->name }}</td>
                        <td>{{ $article->owner->email }}</td>
                        <td>{{ $article->title }}</td>
                        <!-- <td>{{ $article->short }}</td> -->
                        <!-- <td>{{ $article->tags->pluck('name')->implode(', ') }}</td> -->
                        <td>{{  $article->created_at->toFormattedDateString() }}</td>
                        <!-- <td>{{  $article->updated_at->toFormattedDateString() }}</td> -->
                        <td>
                        	<a class="link-danger" href="/articles/{{ $article->slug }}/edit">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection

