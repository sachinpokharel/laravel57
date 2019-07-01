@extends('layouts.admin')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
    <tr>
    <td colspan=8>
    <a href="{{ route('gallerys.create')}}" class="btn btn-danger">
    Add Gallery
    </td>
    </tr>
        <tr>
          <td>ID</td>
          <td>Gallery Name</td>
          <td>Gallery Type</td>
          <td>Category Description</td>
          <td>Status</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($gallerys as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->gtype}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->status}}</td>
            <td><a href="{{ route('gallerys.edit',$item->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('gallerys.destroy', $item->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
