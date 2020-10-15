@extends('admin.layouts.app')

@section('title', 'Visualização de produto')

@section('content')
    <h1>Produto: {{ $product->id }}</h1>

    <ul>
        <li><strong>Nome: </strong> {{ $product->name }}</li>
        <li><strong>Preço: </strong> {{ $product->price }}</li>
        <li><strong>Descrição: </strong> {{ $product->description }}</li>
    </ul>

    <a href="{{ route('products.index') }}" class="btn btn-warning">Voltar</a>
@endsection
