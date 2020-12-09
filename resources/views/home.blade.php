@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form class="form-inline" action="/search">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="Search...">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

            <br>

            <button type="button" class="btn btn-primary">Create New Organization</button>
            </br><br>

            <ul class="list-group">
                <li class="list-group-item">First item</li>
                <li class="list-group-item">Second item</li>
                <li class="list-group-item">Third item</li>
            </ul>

        </div>
    </div>
</div>
@endsection
