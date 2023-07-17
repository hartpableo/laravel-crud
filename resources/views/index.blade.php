@extends('layouts.master')

@section('content')

<section class="mt-5">
  <div class="card">
    <div class="card-header">
      <h1 class="m-0">All Posts</h1>
      <a class="btn btn-sm btn-success" href="{{route('posts.create')}}">Create</a>
      <a class="btn btn-sm btn-warning" href="{{route('posts.trashed')}}">Trashed</a>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" style="width: 5%;">#</th>
            <th scope="col" style="width: 10%;">Image</th>
            <th scope="col" style="width: 10%;">Title</th>
            <th scope="col" style="width: 35%;">Description</th>
            <th scope="col" style="width: 10%;">Category</th>
            <th scope="col" style="width: 10%;">Publish Date</th>
            <th scope="col" style="width: 20%;">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
              
            <tr>
              <th scope="row">{{$post->id}}</th>
              <td>
                <img src="{{asset($post->image)}}" alt="Photo of {{$post->title}}" width="80" height="80" loading="lazy">
              </td>
              <td>{{$post->title}}</td>
              <td>{{$post->description}}</td>
              <td>{{$post->category->name}}</td>
              <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
              <td>
                <a class="btn btn-sm btn-success" href="{{route('posts.show', $post->id)}}">Show</a>
                <a class="btn btn-sm btn-primary" href="{{route('posts.edit', $post->id)}}">Edit</a>
                <form action="{{route('posts.destroy', $post->id)}}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                </form>
              </td>
            </tr>

          @endforeach
        </tbody>
      </table>
      {{$posts->links()}}
    </div>
  </div>
</section>

@endsection