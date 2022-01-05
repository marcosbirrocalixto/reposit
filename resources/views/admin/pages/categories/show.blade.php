@extends('adminlte::page')

@section('title', "Detalhe do Categoria {{ $category->title }}")

@section('content_header')
    <h1>Detalhes do Categoria <b>{{ $category->title }}</b></h1>

    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="card">

        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->title }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $category->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Deletar o Categoria: {{ $category->title }}</button>
        </form>
    </div>
@stop
