@extends('layouts.app')

@section('content')
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
@endsection
