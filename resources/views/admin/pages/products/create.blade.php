@extends('adminlte::page')

@section('title', 'Cadastrar novo Produto')

@section('content_header')
    <h1>Cadastrar Novo Produto</h1>

    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{ Form::open(['route' => 'products.store', 'class' => 'form-group']) }}
                @include('admin.pages.products._partials.form')
            {{ Form::close() }}
            </form>
        </div>
    </div>
@stop'products.store'
