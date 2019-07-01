@extends('back.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="POST" action="{{ route('post.update', $post->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">title:</label>
          <input type="text" class="form-control" name="title" value={{ $post->title}} />
        </div>
        <div class="form-group">
          <label for="price">Description :</label>
          <input type="text" class="form-control" name="description" value={{ $post->description }} />
        </div>
        <div class="form-group">
          <label for="quantity">Status:</label>
          <input type="text" class="form-control" name="status" value={{ $post->status }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
