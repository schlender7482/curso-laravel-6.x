@extends('admin.layouts.app')

@section('title', 'Listagem dos produtos')

@section('content')
    {{-- É assim que se faz um comentário no Blade. --}}
    <h1>Exibindo produtos.</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary">Novo produto</a>

    <hr>
    <form class="form-inline" style="float:right;" action="{{ route('products.index') }}" method="get">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" name="filter" value="{{ request()->get('filter') ?? '' }}" placeholder="Filtrar:">
        </div>
        <button type="submit" class="btn btn-info mb-2">Pesquisar</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width="100">#</th>
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
                    <td>
                        @if ($product->image)
                            <img style="width:50px;height:50px;" src="{{ url("storage/$product->image") }}" alt="{{ $product->name }}">
                        @endif
                    </td>
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

    {!! $products->appends(request()->all())->links() !!}

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
