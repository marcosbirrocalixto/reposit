@extends('adminlte::page')

@section('title', "Editar Categoria {$category->title}")

@section('content_header')
    <h1>Editar Categoria <strong>{{ $category->title }}</strong></h1>

    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id)}}" class="form" method="post">
                @method('PUT')

                @include('admin.pages.categories._partials.form')
          </form>
        </div>
    </div>
@stop
