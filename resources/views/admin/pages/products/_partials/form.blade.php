@include('admin.includes.alerts')

<div class="form-group">
    <label>Nome:</label>
    {{ Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="active">Categoria</label>
    {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label>URL:</label>
    {{ Form::text('url', null, ['placeholder' => 'URL', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    <label>Preço:</label>
    {{ Form::text('price', null, ['placeholder' => 'Preço', 'class' => 'form-control']) }}
</div>
<div class="form-group">
    <label>Descrição:</label>
    {{ Form::textarea('description', null, ['placeholder' => 'Descrição', 'class' => 'form-control']) }}
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
