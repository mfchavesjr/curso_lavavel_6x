@extends('admin.layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')

    @component('admin.components.card')
        @slot('title')
            <h1>Título Card</h1>
        @endslot
        <p>Um card de exemplo</p>
    @endcomponent

    <hr>
    @include('admin.includes.alerts', ['content' => 'Alerta de preços de produtos'])
    <hr>

    <h1>Exibindo os Produtos</h1>

    {{ $teste }}
@endsection

