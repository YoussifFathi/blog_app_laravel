@extends('layout',['headerName'=>'Create Post'])

@section('content')

@if ($errors->any())

        <div class="alert alert-danger" role="alert">   
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>
    
@endif

<form method="POST" action="{{route('posts.store')}}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="{{old('title')}}">
    </div>
    <div class="mb-3">
        <label  class="form-label">Description</label>
        <textarea name="body" class="form-control"  rows="3">{{old('body')}}</textarea>
    </div>

    <div class="mb-3">
        <label  class="form-label">Post Creator</label>
        <select name="user_id" class="form-control">
            @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
            
            
        </select>
    </div>

    <button class="btn btn-success">Submit</button>
</form>


@endsection