@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="GET" class="form-inline" action="/home">
                <div class="form-group">
                    <input type="text" autocomplete="off" class="form-control" name="search" placeholder="Search by Organization, PIC">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            <br>

            @hasrole('admin')
            <a href="/create-organization" class="btn btn-primary">Create New Organization</a>
            </br><br>
            @endhasrole

            <h3>Organization List</h3>

            <ul class="list-group">
                @foreach($organizations as $organization)
                    <li class="list-group-item"><a href="/organization/{{$organization->id}}">{{ $organization->organization_name }}</a></li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
@endsection
