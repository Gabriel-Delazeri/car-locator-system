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
            <h3>Editar Cliente   {{ $costumer['id'] }}</h3>
            <div class="col-md-12">
                <form method="POST" action="/costumers/{{ $costumer['id'] }}">
                    @method('put')
                    @csrf
                    <div class="form-group">
                      <label for="first_name">Primeiro Nome</label>
                      <input type="text" class="form-control" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder="Primeiro Nome" value="{{ $costumer['first_name'] }}">
                    </div>
                    @error('first_name')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                      <label for="last_name">Sobrenome</label>
                      <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Sobrenome" value="{{ $costumer['last_name'] }}">
                    </div>
                    @error('last_name')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="form-group">
                        <label for="document_id">CPF</label>
                        <input type="text" class="form-control" name="document_id" id="document_id" placeholder="CPF" value="{{ $costumer['document_id'] }}">
                    </div>
                    @error('document_id')
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
