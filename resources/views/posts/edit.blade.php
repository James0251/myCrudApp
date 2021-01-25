@extends('app.layout')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if ($message = Session::get('danger'))
                <div class="alert alert-danger">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
                {{-- Ошибки валидации --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @foreach($posts as $post)
                    <form action="{{ action('PostController@update', $post->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="from-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" value="{{ $post->name  }}">
                        </div>
                        <div class="from-group">
                            <label for="detail">Detail</label>
                            <textarea class="form-control" type="text" name="detail">{{ $post->detail  }}</textarea>
                        </div>
                        <div class="from-group">
                            <label for="author">Author</label>
                            <input class="form-control" type="text" name="author" value="{{ $post->author  }}"><br/>
                        </div>
                        <button type="submit" class="btn btn-warning">Update</button>
                        <a href="{{ action('PostController@index') }}" class="btn btn-primary">Back</a>
                    </form>
            @endforeach
        </div>
    </div>
@endsection
