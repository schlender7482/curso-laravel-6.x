@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <input class="form-control" type="text" name="name" value="{{ $product->name ?? old('name') }}" placeholder="Nome:">
</div>
<div class="form-group">
    <input class="form-control" type="text" name="price" value="{{ $product->price ?? old('price') }}" placeholder="Preço:">
</div>
<div class="form-group">
    <input class="form-control" type="text" name="description" value="{{ $product->description ?? old('description') }}" placeholder="Descrição:">
</div>
<div class="form-group">
    <input class="form-control" type="file" name="image">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Salvar</button>
</div>
