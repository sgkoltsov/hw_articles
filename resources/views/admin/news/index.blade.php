@extends('layout.master_without_sidebar')

@section('content')	

    <div class="col-md-8">
        <h3 class="pb-4 mb-0 fst-italic">
            Список новостей
        </h3> 

        <a href="/news/create">
            <button class="btn btn-success mb-4" style="width: 200px;">Добавить новость</button>
        </a>     

        <table class="table">
            <thead>                
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>                    
                    <th scope="col">Create at</th>                    
                    <th scope="col">Edit</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($news as $item) 
                    <tr>
                        <th scope="row">{{ $item->id }}</th>                        
                        <td>{{ $item->title }}</td>                        
                        <td>{{  $item->created_at }}</td>                        
                        <td>
                            <a class="m-0" href="/news/{{ $item->id }}/edit">
                                <button class="btn btn-info">Edit</button>
                            </a>
                        </td>                                                
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $news->links() }}

    </div>
    
@endsection

