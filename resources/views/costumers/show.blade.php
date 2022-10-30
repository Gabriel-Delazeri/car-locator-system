<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<body>
    @include('flash-message')
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
</body>
</html>
