@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/organization/edit" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="organization_id">Organization ID:</label>
      <input type="text" class="form-control" value="{{$organization_id}}" id="organization_id" name="organization_id" readonly>
    </div>
    <div class="form-group">
      <label for="organization_name">Organization Name:</label>
      <input type="text" class="form-control" value="{{$organization->organization_name}}" id="organization_name" placeholder="Organization Name" name="organization_name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" value="{{$organization->email}}" id="email" placeholder="Enter Email" name="email" required>
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" value="{{$organization->phone}}" id="phone" placeholder="Enter Phone Number" name="phone" required>
    </div>
    <div class="form-group">
      <label for="website">Website:</label>
      <input type="text" class="form-control" value="{{$organization->website}}" id="website" placeholder="Enter Website Address" name="website" required>
    </div>
    <div class="form-group">
      <label for="logo">Logo:</label>
      <input type="file" class="form-control" id="logo" name="logo">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
