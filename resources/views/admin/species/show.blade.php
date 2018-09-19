@extends('admin._layouts.main')

@section('title', config('app.name').' | Especies/Razas')

@section('header', 'Especies/Razas')

@section('description', 'Visualizar especie')

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input value="{{ $species->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" disabled>{{ $species->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <a href="{{ route('species.edit', $species) }}" class="btn btn-warning btn-block">Editar especie</a>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de razas asociadas</h3>

            <div class="pull-right box-tools">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('species.breeds.create', $species) }}">
                    <i class="fa fa-plus"></i> Nueva raza
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
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
                @foreach($species->breeds as $breed)
                    <tr>
                        <td>{{ $breed->name }}</td>
                        <td>{{ $breed->description }}</td>
                        <td>{{ $breed->state->name }}</td>
                        @if(isset($breed->deleted_at))
                            <td>
                                <a href="#" class="btn btn-xs btn-info">Restaurar raza</a>
                            </td>
                        @else
                            <td>
                                <a href="{{ route('species.breeds.edit', [$species, $breed]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                <form method="POST" action="{{ route('species.breeds.destroy', [$species, $breed]) }}" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit"
                                            onclick="return confirm('¿Estas seguro de querer eliminar esta raza?')"
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
    </div>
@endsection