@extends('layout',['headerName'=>'Show Post'])

@section('content')


<div class="card w-75 mb-3">
    <div class="card-body">
      <h5 class="card-title">{{$post['title']}}</h5>
      <p class="card-text">{{$post['body']}}</p>
      <a href="{{route('posts.index')}}" class="btn btn-primary">Back</a>
    </div>
  </div>


@endsection