@extends('layouts.master')

@section('content')

<section class="mt-5">
  <div class="card">
    <div class="card-header">
      <h1 class="m-0">Create a Post</h1>
      <a href="" class="btn btn-sm btn-warning">Back</a>
    </div>
    <div class="card-body">
      @if ($errors->any())
          @foreach ($errors->all() as $error)
              <div class="alert alert-danger text-sm">{{$error}}</div>
          @endforeach
      @endif
      <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="image" class="form-label">Image</label>
          <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Category</label>
          <select name="category_id" id="category_id" class="form-select">
            <option selected>Select</option>
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="description">Description</label>
          <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</section>

@endsection