@extends('admin.layouts.app')

@section('title', 'Novo produto')

@section('content')
    <h2>Cadatrar novo Produto.</h2>

    <form class="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.pages.products.partials.form')
    </form>
@endsection
