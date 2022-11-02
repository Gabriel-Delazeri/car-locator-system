@extends('layouts.app')

@section('content')
@include('flash-message')
<h1>Veiculos</h1>
<a href="/vehicles/create">Criar Veiculo</a>
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
        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle['model'] }}</td>
            <td>{{ $vehicle['brand'] }}</td>
            <td>{{ $vehicle['plate'] }}</td>
            <td>{{ $vehicle['year'] }}</td>
            <td>
                <a href="/vehicles/{{$vehicle['id']}}"><i class="bi bi-eye"></i></a>
                <a href="/vehicles/{{ $vehicle['id'] }}/edit"><i class="bi bi-pen"></i></a>
                <form method="post" action="/vehicles/{{$vehicle['id']}}">
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
