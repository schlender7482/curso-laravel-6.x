@extends('admin.layouts.app')

@section('title', 'Listagem dos produtos')

@section('content')
    {{-- É assim que se faz um comentário no Blade. --}}
    <h1>Exibindo produtos.</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary">Novo produto</a>

    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th width="100">Ações</th>
                <th width="100"></th>
                <th width="100"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name}}</td>
                    <td>{{ $product->price}}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                    </td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Visualizar</a>
                    </td>
                    <td>
                        <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>Não existem produtos cadastrados.</tr>
            @endforelse
        </tbody>
    </table>

    {!! $products->links() !!}

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
