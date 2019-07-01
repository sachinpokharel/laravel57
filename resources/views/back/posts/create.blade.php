@extends('layouts.admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add POST
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
      <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="title">post title:</label>
              <input type="text" class="form-control" name="title"/>
          </div>
          <div class="form-group">
              <label for="keyoword">keyword:</label>
              <input type="text" class="form-control" name="keyword"/>
          </div>
          <div class="form-group">
              <label for="description">Description :</label>
              <input type="text" class="form-control" name="description"/>
          </div>
          <div class="form-group">
              <label for="herading">heading:</label>
              <input type="text" class="form-control" name="heading"/>
          </div>
          <div class="form-group">
              <label for="shortstory">:shortstory</label>
              <input type="text" class="form-control" name="shortstory"/>
          </div>
          <div class="form-group">
              <label for="fullstory">:fullstory</label>
              <input type="text" class="form-control" name="fullstory"/>
          </div>
          <div class="form-group">
              <label for="image">:image</label>
              <input type="file" class="form-control" name="files"/>
          </div>
          <div class="form-group">
              <label for="category_id">:category id</label>
              <input type="text" class="form-control" name="categoryid"/>
          </div>
          <div class="form-group">
              <label for="user_id">user id</label>
              <input type="text" class="form-control" name="user_id"/>
          </div>
          <div class="form-group">
              <label for="image">fImage :</label>
              <input type="file" class="form-control" name="files"/>
          </div>
          <div class="form-group">
              <label for="status">Status:</label>
              <input type="text" class="form-control" name="status"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection
