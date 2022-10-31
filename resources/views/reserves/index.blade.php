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
    <h1>Reservas</h1>
    <a href="/reserves/reserve">Reservar Veiculo</a>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Veiculo</th>
                <th>Cliente</th>
                <th>Start</th>
                <th>End</th>
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
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>