@extends('layouts.master')

@section('content')

<section class="mt-5">
  <div class="card">
    <div class="card-header">
      <h1 class="m-0">All Posts</h1>
      <a class="btn btn-sm btn-success" href="{{route('posts.create')}}">Create</a>
      <a class="btn btn-sm btn-warning" href="{{--route('posts.trashed')--}}">Trashed</a>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <tbody>
            {{-- <tr>
              <td>
                <img src="{{asset($post->image)}}" alt="Photo of {{$post->title}}" width="80" height="80" loading="lazy">
              </td>
              <td>{{$post->title}}</td>
              <td>{{$post->category_id}}</td>
              <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
              <td>
                <a class="btn btn-sm btn-primary" href="{{route('posts.edit', $post->id)}}">Edit</a>
                <a class="btn btn-sm btn-danger" href="">Delete</a>
              </td>
            </tr> --}}

            <tr>
              <td>ID</td>
              <td>{{$post->id}}</td>
            </tr>
            <tr>
              <td>Title</td>
              <td>{{$post->title}}</td>
            </tr>
            <tr>
              <td>Image</td>
              <td>{{$post->title}}</td>
            </tr>
            <tr>
              <td>Category</td>
              <td><img src="{{asset($post->image)}}" alt="Photo of {{$post->title}}" width="200" height="200" loading="lazy"></td>
            </tr>
            <tr>
              <td>Description</td>
              <td>{{$post->description}}</td>
            </tr>
            <tr>
              <td>Created</td>
              <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

@endsection