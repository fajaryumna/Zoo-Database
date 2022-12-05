@extends('animal.layout')

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

        <h5 class="card-title fw-bolder mb-3">Insert Animal</h5>

        <form method="post" action="{{ route('animal.store') }}">
            @csrf
            <div class="mb-3">
                <label for="animal_id" class="form-label">Animal ID</label>
                <input type="text" class="form-control" id="animal_id" name="animal_id">
            </div>
            <div class="mb-3">
                <label for="species" class="form-label">Species</label>
                <input type="text" class="form-control" id="species" name="species">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender">
            </div>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="weight" name="weight">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" class="form-control" id="age" name="age">
            </div>
            <div class="mb-3">
                <label for="cage_id" class="form-label">Cage ID</label>
                <input type="text" class="form-control" id="cage_id" name="cage_id">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Insert" />
            </div>
        </form>
    </div>
</div>

@stop