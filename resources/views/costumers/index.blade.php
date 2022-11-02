@extends('layouts.app')

@section('content')
<h1>Clientes</h1>
<a href="/costumers/create">Criar Cliente</a>
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
        @foreach($costumers as $costumer)
        <tr>
            <td>{{ $costumer['first_name'] }}</td>
            <td>{{ $costumer['last_name'] }}</td>
            <td>{{ $costumer['document_id'] }}</td>
            <td>
                <a href="/costumers/{{$costumer['id']}}"><i class="bi bi-eye"></i></a>
                <a href="/costumers/{{ $costumer['id'] }}/edit"><i class="bi bi-pen"></i></a>
                <form method="post" action="/costumers/{{$costumer['id']}}">
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
