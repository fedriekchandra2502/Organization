@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{ asset('storage/'.$organization->logo) }}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{ $organization->organization_name }}</h4>
                      <p class="text-secondary mb-1">{{ $organization->email }}</p>
                      <form method="POST" action="/organization/delete">
                        @csrf
                        @if($userIsManager)
                            <a href="/organization/create-pic/{{$organization->id}}" class="btn btn-primary">Create PIC</a>
                            <a href="/organization/edit/{{$organization->id}}" class="btn btn-outline-primary">Edit</a>
                        @endif
                        @hasrole('admin')
                            <input type="hidden" value="{{$organization->id}}" name="organization_id">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endhasrole
                      </form>
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
                      {{ $organization->organization_name }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $organization->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $organization->phone }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Website</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $organization->website }}
                    </div>
                  </div>
                </div>
              </div>

                @hasrole('admin')
                <!-- assign manager -->
                <div class="card mb-3">
                    <div class="card-body">
                    <div class="col-md-8 mb-3">
                        <form method="POST" action="/organization/assign-manager">
                            @csrf
                            <input type="hidden" name="organization_id" value="{{$organization->id}}">
                            <div class="form-group">
                                <label for="user">Assign Manager (select one):</label>
                                <select class="form-control" id="user" name="user_id" required>
                                    <option value="" selected disabled hidden>Choose here</option>
                                    @foreach($managerCandidate as $candidate)
                                        <option value="{{ $candidate->id }}">{{ $candidate->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Assign Manager</button>
                        </form>
                    </div>
                    </div>
                </div>
                <!--  -->
                @endhasrole


            </div>


          </div>



        <!-- PIC -->
        <h3>PIC List</h3>
        <div class="row">
            @foreach($pics as $pic)
            <div class="col-md-4">
                <div class="card user-card">
                    <div class="card-header">
                        <h5>Profile</h5>
                    </div>
                    <div class="card-block">
                        <div class="user-image">
                            <img src="{{ asset('storage/'.$pic->avatar) }}" class="img-radius" alt="User-Profile-Image">
                        </div>
                        <h6 class="f-w-600 m-t-25 m-b-10">{{ $pic->pic_name }}</h6>
                        <p class="text-muted"> {{ $pic->email }} | {{ $pic->phone }}</p>
                        <hr>
                        @if($userIsManager)
                        <form method="POST" action="/organization/delete-pic">
                            @csrf
                            <input type="hidden" name="pic_id" value="{{$pic->id}}">
                            <input type="hidden" name="organization_id" value="{{$organization->id}}">
                            <button class="btn btn-primary">Delete</button>
                            <a href="/organization/edit-pic/{{$organization->id}}/{{$pic->id}}" class="btn btn-outline-primary">Edit</a>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>
</div>
@endsection
