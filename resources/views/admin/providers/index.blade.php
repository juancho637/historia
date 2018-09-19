@extends('admin._layouts.main')

@section('title', config('app.name').' | Proveedores')

@section('header', 'Proveedores')

@section('description', 'Página para gestión de proveedores')

@push('styles')

@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de proveedores</h3>
            <div class="box-tools pull-right">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('providers.create') }}">
                    <i class="fa fa-plus"></i> Nuevo proveedor
                </a>
            </div>
        </div>
        <div class="box-body">
            <table id="providers-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($providers as $provider)
                        <tr>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->description }}</td>
                            <td>{{ $provider->state->name }}</td>
                            @if(isset($provider->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar usuario</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('providers.edit', $provider) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('providers.destroy', $provider) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"
                                                onclick="return confirm('¿Estas seguro de querer eliminar este proveedor?')"
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
        <center>{{ $providers->links() }}</center>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

        });
    </script>
@endpush