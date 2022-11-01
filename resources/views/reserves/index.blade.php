@extends('layouts.app')

@section('content')
<h1>Reservas</h1>
<a href="/reserves/create">Reservar Veiculo</a>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Veiculo</th>
            <th>Cliente</th>
            <th>Start</th>
            <th>End</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reserves as $reserve)
        <tr>
            <td>{{ $reserve['id'] }}</td>
            <td>{{ $reserve['vehicle_id'] }}</td>
            <td>{{ $reserve['costumer_id'] }}</td>
            <td>{{ $reserve['start_date'] }}</td>
            <td>{{ $reserve['end_date'] }}</td>
            <td>
                <a href="/reserves/{{$reserve['id']}}"><i class="bi bi-eye"></i></a>
                <a href="/reserves/{{ $reserve['id'] }}/edit"><i class="bi bi-pen"></i></a>
                <form method="post" action="/reserves/{{$reserve['id']}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="bi bi-trash"></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
