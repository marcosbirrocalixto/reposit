@include('admin.includes.alerts')

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $product->name ?? old('name') }}">
</div>
<div class="form-group">
    <label for="active">Categoria</label>
    <select class="form-control" name="category_id">
        @foreach ($categories as $id => $category) 
            @if (isset($product->category_id) && $product->category_id == $d )
                <option selected value="{{ $category->id }}">{{ $category->title }}</option>
            @endif
                <option value="{{ $id }}">{{ $category }}</option>    
        @endforeach
    </select> 
</div>
<div class="form-group">
    <label>URL:</label>
    <input type="text" name="url" class="form-control" placeholder="URL:" value="{{ $product->url ?? old('url') }}">
</div>
<div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" cols="30" rows="5" class="form-control">{{ $product->description ?? old('description') }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
