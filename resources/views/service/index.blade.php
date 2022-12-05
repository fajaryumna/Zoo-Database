@extends('service.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h2 class="my-4 bg-white text-dark rounded-2 text-center">Service Information</h2>

@if($message = Session::get('success'))
<div class="alert alert-success mt-3" role="alert">
    {{ $message }}
</div>
@endif

<table class="table text-center table-hover bg-light rounded-2">
    <thead>
        <tr>
            <th>Service ID</th>
            <th>Animal</th>
            <th>Zoo Keeper</th>
            <th>Service Type</th>
            <th>Service Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
        <tr>
            <td>{{ $data->service_id }}</td>
            <td>{{ $data->animal }}</td>
            <td>{{ $data->penjaga }}</td>
            <td>{{ $data->service_type }}</td>
            <td>{{ $data->service_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop