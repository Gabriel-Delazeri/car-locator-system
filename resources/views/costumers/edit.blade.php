@extends('layouts.app')

@section('content')
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
@endsection
