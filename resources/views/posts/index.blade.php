@extends('layout',['headerName'=>'All Posts'])

@section('content')



  <div class="text-center">
      <a type="button" class="btn btn-success" href="{{route('posts.create')}}">
        Create Post
          
        </a>    
  </div>

  <table class="table mt-4">
      <thead>
      <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Posted By</th>
          <th scope="col">Created At</th>
          <th scope="col">Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach($posts as $post)
          <tr>
              <td>{{$post['id']}}</td>
              <td>{{$post['title']}}</td>
              <td>{{$post->user ? $post->user->name : "Anonymous"}}</td>
              <td>{{$post['created_at']}}</td>
              <td>
                  <a href="{{route('posts.show', ['id'=>$post['id']])}}" class="btn btn-info">View</a>
                  <a href="{{route('posts.edit', ['id'=>$post['id']])}}" class="btn btn-primary">Edit</a>
                  <form method="POST" action="{{route('posts.destroy', ['id'=>$post['id']])}}"style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
              </td>
          </tr>
      @endforeach


      </tbody>
  </table>


@endsection