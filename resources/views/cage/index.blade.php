@extends('cage.layout')

@section('content')

<h2 class="my-3 bg-white text-center text-dark rounded-2">Cage Data</h2>

<a href="{{ route('cage.create') }}" type="button" class="btn btn-success rounded-3">Insert Data</a>
<a href="{{ route('cage.trash') }}" type="button" class="btn btn-secondary rounded-3">Trash</a>

<div class="row align-items-center my-3">
    <div class="col-auto">
        <form action="{{ route('cage.index') }}" method="GET">
            <input type="text" id="search" name="search" class="form-control" value="{{request('search')}}">
        </form>
    </div>
</div>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table text-center bg-light table-hover ">
    <thead>
        <tr>
            <th>Cage ID</th>
            <th>Type</th>
            <th>Size</th>
            <th>Date Built</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->cage_id }}</td>
            <td>{{ $data->type }}</td>
            <td>{{ $data->size }}</td>
            <td>{{ $data->date_built }}</td>
            <td>
                <a href="{{ route('cage.edit', $data->cage_id) }}" type="button"
                    class="btn btn-warning rounded-3">Ubah</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $data->cage_id }}">
                    Buang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $data->cage_id }}" tabindex="-1"
                    aria-labelledby="hapusModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('cage.softDeleted', $data->cage_id) }}">
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
        {{-- <tr>
            <td>1</td>
            <td>Mark</td>
            <td>Otto</td>
            <td>test</td>
            <td>
                <a href="#" type="button" class="btn btn-warning rounded-3">Ubah</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal">
                    Hapus
                </button>

                <!-- Modal -->
                <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr> --}}
    </tbody>
</table>
@stop