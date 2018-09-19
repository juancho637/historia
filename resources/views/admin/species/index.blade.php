@extends('admin._layouts.main')

@section('title', config('app.name').' | Especies/Razas')

@section('header', 'Especies/Razas')

@section('description', 'Página para gestión de especies/razas')

@push('styles')

@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de especies</h3>
            <div class="box-tools pull-right">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('species.create') }}">
                    <i class="fa fa-plus"></i> Nueva especie
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($species as $kind)
                        <tr>
                            <td>{{ $kind->name }}</td>
                            <td>{{ $kind->description }}</td>
                            <td>{{ $kind->state->name }}</td>
                            @if(isset($kind->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar especie</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('species.show', $kind) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('species.edit', $kind) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('species.destroy', $kind) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar esta especie?')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <center>{{ $species->links() }}</center>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

        });
    </script>
@endpush