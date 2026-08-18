extends('layouts.app')


@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gerenciamento de Clientes</h2>
    <a href="{{ route('costumers.create') }}" class="btn btn-primary">Novo Cliente</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Proprietário</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($costumers as $costumer)
                        <tr>
                            <td>{{ $costumer->name }}</td>
                            <td>{{ $costumer->owner }}</td>
                            <td>{{ $costumer->email }}</td>
                            <td>{{ $costumer->phone }}</td>
                            <td>{{ $costumer->address }}</td>

                            <td class="text-end">
                                <a href="{{ route('costumers.show', $costumer) }}" class="btn btn-sm btn-info text-white">Ver</a>

                                 <a href="{{ route('costumers.edit', $costumer) }}" class="btn btn-sm btn-warning">Editar</a>

                                 @if(auth()->user()->id !== $costumer->id)
                                    <form action="{{ route('costumers.destroy', $costumer) }}"
                                    method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este cliente?')">

                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Excluir</button>

                                    </form>
                                 @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center py-4 text-muted" colspan="6">Nenhum cliente cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>