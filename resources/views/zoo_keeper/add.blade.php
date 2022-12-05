@extends('zoo_keeper.layout')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)

        <li>{{ $error }}</li>

        @endforeach
    </ul>
</div>
@endif

<div class="card mt-4">
    <div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Inser Zoo Keeper</h5>

        <form method="post" action="{{ route('zoo_keeper.store') }}">
            @csrf
            <div class="mb-3">
                <label for="zookeeper_id" class="form-label">Zoo Keeper ID</label>
                <input type="text" class="form-control" id="zookeeper_id" name="zookeeper_id">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="year_hired" class="form-label">Year Hired</label>
                <input type="text" class="form-control" id="year_hired" name="year_hired">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Insert" />
            </div>
        </form>
    </div>
</div>

@stop