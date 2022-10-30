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
    <div class="container">
        <div class="row">
            <h3>Editar Veiculo   {{ $vehicle['id'] }}</h3>
            <div class="col-md-12">
                <form method="POST" action="/vehicles/{{ $vehicle['id'] }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                      <label for="model">Modelo</label>
                      <input type="text" class="form-control" name="model" id="model" aria-describedby="emailHelp" placeholder="Modelo" value="{{ $vehicle['model'] }}">
                    </div>
                    @error('model')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                      <label for="brand">Marca</label>
                      <input type="text" class="form-control" name="brand" id="brand" placeholder="Marca" value="{{ $vehicle['brand'] }}">
                    </div>
                    @error('brand')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="plate">Placa</label>
                        <input type="text" class="form-control" name="plate" id="plate" placeholder="Placa" value="{{ $vehicle['plate'] }}">
                    </div>
                    @error('plate')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="year">Ano</label>
                        <input type="text" class="form-control" name="year" id="year" placeholder="Ano" value="{{ $vehicle['year'] }}">
                    </div>
                    @error('year')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
