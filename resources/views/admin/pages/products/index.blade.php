@extends('admin.layouts.app')

@section('title', 'Listagem dos produtos')

@section('content')
    {{-- É assim que se faz um comentário no Blade. --}}

    <h1>Exibindo produtos.</h1>

    <a href="{{ route('products.create') }}">Novo produto</a>

    <hr>

    @foreach($produtos as $produto)
        <p>{{ $loop->index.' - '.$produto }}</p>
    @endforeach

    <hr>

    @forelse($produtos as $produto)
        <p>{{ $produto }}</p>
    @empty
        <p>Não existem produtos cadastrados.</p>
    @endforelse

    <hr>
    @include('admin.includes.alerts', ['message' => 'Teste de funcionamento de alert.'])

    <hr>
    @component('admin.components.card')
        @slot('titulo')
            <h3>Título do card</h3>
        @endslot
        Valor do card.
    @endcomponent
@endsection

@push('scripts')
    <script>
        document.body.style.backgroundColor = "#dedede";
    </script>
@endpush
