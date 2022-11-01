@extends('layouts.app')

@section('content')
<h3>Registrar Veiculo</h3>
<div class="col-md-12">
    @include('flash-message')
    <form method="POST" action="/vehicles">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="model">Modelo</label>
            <input type="text" class="form-control" name="model" id="model" aria-describedby="emailHelp" placeholder="Modelo">
        </div>
        @error('model')
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="brand">Marca</label>
            <input type="text" class="form-control" name="brand" id="brand" placeholder="Marca">
        </div>
        @error('brand')
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="plate">Placa</label>
            <input type="text" class="form-control" name="plate" id="plate" placeholder="Placa">
        </div>
        @error('plate')
        <div class="invalid-feedback d-block">
            {{$message}}
        </div>
        @enderror
        <div class="form-group">
            <label for="year">Ano</label>
            <input type="text" class="form-control" name="year" id="year" placeholder="Ano">
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
