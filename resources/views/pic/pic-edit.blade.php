@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/organization/edit-pic" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="organization_id">Organization ID:</label>
      <input type="text" class="form-control" value="{{$organization_id}}" id="organization_id" name="organization_id" readonly>
    </div>
    <div class="form-group">
      <label for="pic_id">PIC ID:</label>
      <input type="text" class="form-control" value="{{$pic->id}}" id="pic_id" name="pic_id" readonly>
    </div>
    <div class="form-group">
      <label for="pic_name">PIC Name:</label>
      <input type="text" class="form-control" value="{{$pic->pic_name}}" id="pic_name" placeholder="PIC Name" name="pic_name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" value="{{$pic->email}}" id="email" placeholder="Enter Email" name="email" required>
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" value="{{$pic->phone}}" id="phone" placeholder="Enter Phone Number" name="phone" required>
    </div>
    <div class="form-group">
      <label for="avatar">Avatar:</label>
      <input type="file" class="form-control" id="avatar" name="avatar">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
