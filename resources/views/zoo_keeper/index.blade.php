@extends('zoo_keeper.layout')

@section('content')

<h2 class="my-3 bg-white text-center text-dark rounded-2">Zoo Keeper Data</h2>

<a href="{{ route('zoo_keeper.create') }}" type="button" class="btn btn-success rounded-3">Insert Data</a>
<a href="{{ route('zoo_keeper.trash') }}" type="button" class="btn btn-secondary rounded-3">Trash</a>

<div class="row align-items-center my-3">
    <div class="col-auto">
        <form action="{{ route('zoo_keeper.index') }}" method="GET">
            <input type="text" id="search" name="search" class="form-control" value="{{request('search')}}">
        </form>
    </div>
</div>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table text-center bg-light  table-hover mt-2">
    <thead>
        <tr>
            <th>Zoo Keeper ID</th>
            <th>Name</th>
            <th>Year Hired</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->zookeeper_id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->year_hired }}</td>
            <td>{{ $data->age }}</td>
            <td>
                <a href="{{ route('zoo_keeper.edit', $data->zookeeper_id) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->zookeeper_id }}">
                    Buang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->zookeeper_id }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('zoo_keeper.softDeleted', $data->zookeeper_id) }}">
                                @csrf
                                <div class="modal-body">
                                    Apakah anda yakin ingin membuang data ini?
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