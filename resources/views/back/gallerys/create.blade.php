@extends('layouts.admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Gallery
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
      <form method="POST" action="{{ route('gallerys.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="name">Gallery Name:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="gtype">Gallery Type:</label>
              <input type="text" class="form-control" name="gtype"/>
          </div>
          <div class="form-group">
              <label for="description">Gallery Description :</label>
              <input type="text" class="form-control" name="description"/>
          </div>
          <div class="form-group">
              <label for="image">Gallery Image :</label>
              <input type="file" class="form-control" name="files"/>
          </div>
          <div class="form-group">
              <label for="status">Gallery Status:</label>
              <input type="text" class="form-control" name="status"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection
