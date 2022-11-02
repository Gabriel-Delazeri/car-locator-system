@extends('layouts.app')

@section('content')
<h1>Reserva {{ $reserve->id }}</h1>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Veiculo</th>
            <th>Cliente</th>
            <th>Start</th>
            <th>End</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $reserve['id'] }}</td>
            <td>{{ $reserve['vehicle_id'] }}</td>
            <td>{{ $reserve['costumer_id'] }}</td>
            <td>{{ $reserve['start_date'] }}</td>
            <td>{{ $reserve['end_date'] }}</td>
            <td>
                <a href="/reserves/{{ $reserve['id'] }}/edit"><i class="bi bi-pen"></i></a>
                <form method="post" action="/reserves/{{$reserve['id']}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="bi bi-trash"></button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
@endsection
