@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>John Doe</h4>
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <a class="btn btn-primary">Create PIC</a>
                      <a class="btn btn-outline-primary">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Organization Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Kenneth Valdez
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      fip@jukmuh.al
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      (239) 816-9029
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Website</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Bay Area, San Francisco, CA
                    </div>
                  </div>
                </div>
              </div>

                <!-- assign manager -->
                <div class="card mb-3">
                    <div class="card-body">
                    <div class="col-md-8 mb-3">
                        <form method="POST" action="/organization/assign-manager">
                            <div class="form-group">
                                <label for="sel1">Assign Manager (select one):</label>
                                <select class="form-control" id="sel1" name="sellist1">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Assign Manager</button>
                        </form>
                    </div>
                    </div>
                </div>
                <!--  -->

            </div>


          </div>



        <!-- PIC -->
        <div class="row">

            <div class="col-md-4">
                <div class="card user-card">
                    <div class="card-header">
                        <h5>Profile</h5>
                    </div>
                    <div class="card-block">
                        <div class="user-image">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image">
                        </div>
                        <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                        <p class="text-muted"> alessa@gmail.com | +628128525423</p>
                        <hr>
                        <button class="btn btn-primary">Delete</button>
                        <button class="btn btn-outline-primary">Edit</button>
                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
@endsection
