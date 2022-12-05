@extends('animal.layout')

@section('content')

<h2 class="my-3 bg-white text-dark rounded-2 text-center">Animal Data</h2>

<div class="">
    <a href="{{ route('animal.create') }}" type="button" class="btn btn-success rounded-3">Insert Data</a>
    <a href="{{ route('animal.trash') }}" type="button" class="btn btn-secondary rounded-3">Trash</a>

    <div class="row align-items-center my-3">
        <div class="col-auto">
            <form action="{{ route('animal.index') }}" method="GET">
                <input type="text" id="search" name="search" class="form-control" value="{{request('search')}}">
            </form>
        </div>
    </div>
</div>


@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table text-center bg-light table-hover mt-2">
    <thead>
        <tr>
            <th>Animal ID</th>
            <th>Species</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Weight</th>
            <th>Age</th>
            <th>Cage ID</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->animal_id }}</td>
            <td>{{ $data->species }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->gender }}</td>
            <td>{{ $data->weight }}</td>
            <td>{{ $data->age }}</td>
            <td>{{ $data->cage_id }}</td>
            <td class="text-center">
                <a href="{{ route('animal.edit', $data->animal_id) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->animal_id }}">
                    Buang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->animal_id }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('animal.softDeleted', $data->animal_id) }}">
                                @csrf
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus data ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Ya</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop