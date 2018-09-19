@extends('admin._layouts.main')

@section('title', config('app.name').' | Clientes/Mascotas')

@section('header', 'Clientes/Mascotas')

@section('description', 'Página para gestión de clientes/mascotas')

@push('styles')

@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de clientes</h3>
            <div class="box-tools pull-right">
                <form class="pull-left">
                    <div class="input-group input-group-sm" style="width: 400px;">
                        <input type="text" name="search" class="form-control" aria-label="...">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            <a class="btn btn-default" href="{{ route('clients.create') }}" role="button"><i class="fa fa-plus"></i> Nuevo cliente</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="clients-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono celular</th>
                        {{-- <th>Dirección</th> --}}
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->full_name }}</td>
                            <td>{{ $client->type_identification.'. '.$client->identification }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->cell_phone }}</td>
                            <td>{{ $client->state->name }}</td>
                            @if(isset($client->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar usuario</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('clients.show', $client) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('clients.destroy', $client) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"
                                                onclick="return confirm('¿Estas seguro de querer eliminar este cliente?')"
                                                class="btn btn-xs btn-danger">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <center>{{ $clients->links() }}</center>
    </div>
@endsection

@push('scripts')
    <!-- Code -->
    <script>
        $(function () {

        });
    </script>
@endpush