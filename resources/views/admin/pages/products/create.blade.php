@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>

   @include('admin.includes.alerts')

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Nome:" value="{{  old('name') }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="price" placeholder="Preço:" value="{{  old('price') }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="description" placeholder="Descrição:" value="{{  old('description') }}">
        </div>
        <div class="form-group">
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
@endsection
