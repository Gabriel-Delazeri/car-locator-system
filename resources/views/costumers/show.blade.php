@extends('layouts.app')

@section('content')
<h1>{{ $costumer['first_name']}} {{  $costumer['last_name'] }}</h1>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $costumer['first_name'] }}</td>
            <td>{{ $costumer['last_name'] }}</td>
            <td>{{ $costumer['document_id'] }}</td>
            <td>
                <a href="/costumers/{{ $costumer['id'] }}/edit"><i class="bi bi-pen"></i></a>
                <form method="post" action="/costumers/{{$costumer['id']}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="bi bi-trash"></button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
@endsection
