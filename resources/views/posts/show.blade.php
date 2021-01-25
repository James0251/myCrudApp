@extends('app.layout')

@section('content')
    <div class="card" style="width: 350px;">
        @foreach($posts as $post)
            <img class="card-img-top" src="http://via.placeholder.com/350x150?text={{ $post->name }}">
            <div class="card-body">
                <div class="card-text">{{ $post->detail }}</div><br/>
                <p class="card-title">{{ $post->author }}</p>
                <a href="{{ action('PostController@index') }}" class="btn btn-primary">Back</a>
            </div>
        @endforeach
    </div>
@endsection
