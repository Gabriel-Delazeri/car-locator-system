@extends('layouts.app')

@section('content')
<h1>{{ $vehicle['model']}} {{  $vehicle['brand'] }}</h1>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Placa</th>
            <th>Ano</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $vehicle['model'] }}</td>
            <td>{{ $vehicle['brand'] }}</td>
            <td>{{ $vehicle['plate'] }}</td>
            <td>{{ $vehicle['year'] }}</td>
            <td>
                <a href="/vehicles/{{ $vehicle['id'] }}/edit"><i class="bi bi-pen"></i></a>
                <form method="post" action="/vehicles/{{$vehicle['id']}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="bi bi-trash"></button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
@endsection
