@extends('layouts.master')

@section('content')

<section class="mt-5">
  <div class="card">
    <div class="card-header">
      <h1 class="m-0">Edit Your Post: {{$post->title}}</h1>
      <a href="" class="btn btn-sm btn-warning">Back</a>
    </div>
    <div class="card-body">
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="alert alert-danger text-sm">{{$error}}</div>
          @endforeach
      @endif
      <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <div>
            <img src="{{asset($post->image)}}" alt="Photo of {{$post->title}}" width="200" height="180" loading="lazy">
          </div>
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Category</label>
          <select name="category_id" id="category_id" class="form-select">
            <option selected>Select</option>
            @foreach ($categories as $category)
              <option {{$category->id == $post->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="description">Description</label>
          <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$post->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</section>

@endsection