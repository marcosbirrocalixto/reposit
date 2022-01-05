@extends('adminlte::page')

@section('title', 'Categoria')

@section('content_header')
    <h1>Categorias  <a href="{{ route('categories.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Categoria</a></h1>
    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('categories.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="title" placeholder="Título pesquisa" class="form-control" value="{{ $data['title'] ?? ''}}">
                <input type="text" name="url" placeholder="URL para pesquisa" class="form-control" value="{{ $data['url'] ?? ''}}">
                <input type="text" name="description" placeholder="Descrição para pesquisa" class="form-control" value="{{ $data['description'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        
            @if (isset($data))
            <div class="card-body">
            <p><strong><a href="{{ route('categories.index')}}">(X) Limpar resultado da pesquisa.</a></strong></p>
            </div>
            @endif

        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>URL</th>
                        <th>Descrição</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                    <tr>
                        <td>
                            {{ $categorie->id }}
                        </td>
                        <td>
                            {{ $categorie->title }}
                        </td>
                        <td>
                            {{ $categorie->url }}
                        </td>
                        <td>
                            {{ $categorie->description }}
                        </td>
                        <td style="width: 10px">
                            <a href="{{route('categories.edit', $categorie->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('categories.show', $categorie->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            @if (isset($data))
                {!! $categories->appends($data)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop
