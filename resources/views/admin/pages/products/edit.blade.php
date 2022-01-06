@extends('adminlte::page')

@section('name', "Editar Produto {$product->name}")

@section('content_header')
    <h1>Editar Produto <strong>{{ $product->name }}</strong></h1>

    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')

            {{ Form::model($product, ['route' => ['products.update', $product->id], 'class' => 'form-group']) }}
                @method('PUT')
                @include('admin.pages.products._partials.form')
            {{ Form::close() }}
        </div>
    </div>
@stop
