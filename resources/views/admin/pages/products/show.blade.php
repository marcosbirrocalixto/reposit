@extends('adminlte::page')

@section('title', "Detalhe do Produto {{ $product->title }}")

@section('content_header')
    <h1>Detalhes do Produto <b>{{ $product->title }}</b></h1>

    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $product->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $product->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Produto: {{ $product->title }}</button>
        </form>
    </div>
@stop
