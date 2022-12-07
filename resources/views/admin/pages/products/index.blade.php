@extends('admin.layouts.app')

@section('title', 'Gestão de Produtos')

@section('content')

    <h1>Exibindo os Produtos</h1>

    <a href="{{ route('products.create')}}">Cadastrar</a>

    <hr>

    @component('admin.components.card')
        @slot('title')
            <h1>Título Card</h1>
        @endslot
        <p>Um card de exemplo</p>
    @endcomponent

    <hr>
    @include('admin.includes.alerts', ['content' => 'Alerta de preços de produtos'])
    <hr>



    {{ $teste }}
@endsection

@push('styles')
    <style>
        .last {background: #ccc}
    </style>
@endpush
@push('scripts')
    <script>
        document.body.style.background = '#efefef'
    </script>
@endpush
