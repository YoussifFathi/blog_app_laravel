@extends('layout',['headerName'=>'Edit Post'])

@section('content')

@if ($errors->any())

        <div class="alert alert-danger" role="alert">   
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </div>

@endif


<form method="POST" action="{{route('posts.update',['id'=>$id])}}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Title {{$id}}</label>
        <input name="title" type="text" class="form-control" value="{{$post->title}}">
    </div>
    <div class="mb-3">
        <label  class="form-label">Description</label>
        <textarea name="body" class="form-control"  rows="3" >{{$post->body}}</textarea>
    </div>

    <div class="mb-3">
        <label  class="form-label">Post Creator</label>
        <select name="user_id" class="form-control" >
            @foreach ($users as $user)
            <option @if ($user->id == $post->user_id) selected
                
            @endif value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Submit</button>
</form>


@endsection