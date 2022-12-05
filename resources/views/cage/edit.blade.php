@extends('cage.layout')

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

        <h5 class="card-title fw-bolder mb-3">Ubah Data Cage</h5>

        <form method="post" action="{{ route('cage.update', $data->cage_id) }}">
            @csrf
            <div class="mb-3">
                <label for="cage_id" class="form-label">Cage ID</label>
                <input type="text" class="form-control" id="cage_id" name="cage_id" value="{{ $data->cage_id }}">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $data->type }}">
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size</label>
                <input type="text" class="form-control" id="size" name="size" value="{{ $data->size }}">
            </div>
            <div class="mb-3">
                <label for="date_built" class="form-label">Date Built</label>
                <input type="date" class="form-control" id="date_built" name="date_built"
                    value="{{ $data->date_built }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Update" />
            </div>
        </form>
    </div>
</div>

@stop