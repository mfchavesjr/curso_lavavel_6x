@extends('admin.layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <h1>Editar Produto {{ $id }}</h1>

    <form action="{{ route('products.update', $id) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <button type="submit">Editar</button>
    </form>
@endsection
