@extends('admin._layouts.main')

@section('title', config('app.name').' | Usuarios')

@section('header', 'Usuarios')

@section('description', 'Página para gestión de usuarios')

@push('styles')

@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de usuarios</h3>
            <div class="box-tools pull-right">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
                    <i class="fa fa-plus"></i> Nuevo usuario
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="users-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Cédula</th>
                        <th>Cargo</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono celular</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->identification }}</td>
                            <td>{{ $user->occupation->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->cell_phone }}</td>
                            <td>{{ $user->state->name }}</td>
                            @if(isset($user->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar usuario</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('users.show', $user) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('¿Estas seguro de querer eliminar este usuario?')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <center>{{ $users->links() }}</center>
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {

        });
    </script>
@endpush