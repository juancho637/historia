@extends('admin._layouts.main')

@section('title', config('app.name').' | Productos/Servicios')

@section('header', 'Productos/Servicios')

@section('description', 'Página para gestión de productos/servicios')

@push('styles')

@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de productos/servicios</h3>
            <div class="box-tools pull-right">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('products.create') }}">
                    <i class="fa fa-plus"></i> Nuevo producto/servicio
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped" id="products-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Impuestos</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>$ {{ number_format($product->value) }}</td>
                            <td>{{ $product->tax_percentage }}%</td>
                            <td>{{ ucwords($product->type) }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->state->name }}</td>
                            @if(isset($product->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar producto</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"
                                                onclick="return confirm('¿Estas seguro de querer eliminar este producto/servicio?')"
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
        <center>{{ $products->links() }}</center>
    </div>
@endsection

@push('scripts')
    <!-- Code -->
    <script>
        $(function () {

        });
    </script>
@endpush