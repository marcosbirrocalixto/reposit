@extends('adminlte::page')

@section('title', 'Produto')

@section('content_header')
    <h1>Produtos  <a href="{{ route('products.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Adicionar Produto</a></h1>
    <hr>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card header">
            <form action="{{ route('products.search')}}" method="POST" class="form form-inline">
                @csrf

                <select name="category" class="form-control">
                    <option value="">Categorias</option>
                    @foreach($categories as $id => $category)
                        <option value="{{  $id }}" @if (isset($filters['category']) && $filters['category'] == $id) selected @endif>{{  $category }}</option>
                    @endforeach
                </select>
                <input type="text" name="name" placeholder="Título ou Descrição para pesquisa" class="form-control" value="{{ $filters['name'] ?? ''}}">
                <input type="text" name="url" placeholder="URL para pesquisa" class="form-control" value="{{ $filters['url'] ?? ''}}">
                <input type="text" name="price" placeholder="Preço para pesquisa" class="form-control" value="{{ $filters['price'] ?? ''}}">
                <button type="submit" class="btn btn-primary"><i class="fab fa-searchengin"></i> Pesquisar </button>
            </form>
        </div>
        
            @if (isset($filters))
            <div class="card-body">
            <p><strong><a href="{{ route('products.index')}}">(X) Limpar resultado da pesquisa.</a></strong></p>
            </div>
            @endif

        <div class="card-body">

            @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ $product->category->title }}
                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->description }}
                        </td>
                        <td style="width: 200px">
                            <a href="{{route('products.edit', $product->id)}}" class="btn btn-info">Edit</a>
                            <a href="{{route('products.show', $product->id)}}" class="btn btn-warning">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop
