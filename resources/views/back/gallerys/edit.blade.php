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
      <form method="post" action="{{ route('gallerys.update', $gallerys->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value={{ $gallerys->name }} />
        </div>
        <div class="form-group">
          <label for="gtype">Type:</label>
          <input type="text" class="form-control" name="gtype" value={{ $gallerys->gtype }} />
        </div>
        <div class="form-group">
          <label for="description">Description :</label>
          <input type="text" class="form-control" name="description" value={{ $gallerys->description }} />
        </div>
        <div class="form-group">
          <label for="quantity">Status:</label>
          <input type="text" class="form-control" name="status" value={{ $gallerys->status }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection





