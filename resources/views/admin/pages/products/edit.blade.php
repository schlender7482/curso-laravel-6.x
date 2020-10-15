@extends('admin.layouts.app')

@section('title', 'Editar produto')

@section('content')
    <h2>Editar novo Produto {{ $product->name }}</h2>

    <form class="form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.pages.products.partials.form')
    </form>
@endsection
