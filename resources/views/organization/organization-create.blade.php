@extends('layouts.app')

@section('content')
<div class="container">
  <form action="/action_page.php">
    <div class="form-group">
      <label for="org_name">Organization Name:</label>
      <input type="text" class="form-control" id="org_name" placeholder="Organization Name" name="organization_name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone" required>
    </div>
    <div class="form-group">
      <label for="website">Website:</label>
      <input type="text" class="form-control" id="website" placeholder="Enter Website Address" name="website" required>
    </div>
    <div class="form-group">
      <label for="avatar">Avatar:</label>
      <input type="file" class="form-control" id="avatar" name="avatar" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection
