@extends('admin._layouts.main')

@section('title', config('app.name').' | Categorías')

@section('header', 'Categorías')

@section('description', 'Página para gestión de categorías/productos')

@push('styles')

@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de categorías</h3>
            <div class="box-tools pull-right">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('categories.create') }}">
                    <i class="fa fa-plus"></i> Nueva categoría
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-striped" id="categories-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->state->name }}</td>
                            @if(isset($category->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar categoría</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"
                                                onclick="return confirm('¿Estas seguro de querer eliminar esta categoría?')"
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
        <center>{{ $categories->links() }}</center>
    </div>
@endsection

@push('scripts')
    <!-- Code -->
    <script>
        $(function () {

        });
    </script>
@endpush