@extends('admin._layouts.main')

@section('title', config('app.name').' | Productos/Servicios')

@section('header', 'Productos/Servicios')

@section('description', 'Visualizar producto/servicio')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input value="{{ $product->name }}" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="value">Precio:</label>
                        <input value="{{ $product->value }}" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Porcentaje de impuestos:</label>
                        <input value="{{ $product->tax_percentage }}" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label>Tipo:</label>
                        <input value="{{ $product->type === 'producto' ? 'Producto' : 'Servicio' }}" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <label>Categorías:</label>
                        <select class="form-control select2" multiple="multiple" style="width: 100%;" disabled>
                            @foreach($product->categories as $category)
                                <option {{ collect($product->categories->pluck('id'))->contains($category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form-group">
                        <label>Proveedores:</label>
                        <select class="form-control select2" multiple="multiple" style="width: 100%;" disabled>
                            @foreach($product->providers as $provider)
                                <option {{ collect($product->providers->pluck('id'))->contains($provider->id) ? 'selected' : '' }} value="{{ $provider->id }}">{{ $provider->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Descripción:</label>
                        <textarea class="form-control" disabled>{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-block">Editar producto/servicio</a>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de stocks asociados</h3>

            <div class="pull-right box-tools">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('products.stocks.create', $product) }}">
                    <i class="fa fa-plus"></i> Nuevo stock
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Monto comprado</th>
                        <th>Stock</th>
                        <th>Stock mínimo</th>
                        <th>Fecha de caducidad</th>
                        <th>Lote no.</th>
                        <th>Proveedor</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->stocks as $stock)
                        <tr {{ color_stock_helper($stock->due_date) }}>
                            <td>{{ $stock->purchase_amount }}</td>
                            <td>{{ $stock->stock }}</td>
                            <td>{{ $stock->stock_min }}</td>
                            <td>{{ $stock->due_date }}</td>
                            <td>{{ $stock->lot }}</td>
                            <td>{{ $stock->provider->name }}</td>
                            <td>{{ $stock->state->name }}</td>
                            @if(isset($stock->deleted_at))
                                <td>
                                    <a href="#" class="btn btn-xs btn-info">Restaurar stock</a>
                                </td>
                            @else
                                <td>
                                    <a href="{{ route('products.stocks.edit', [$product, $stock]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                    <form method="POST" action="{{ route('products.stocks.destroy', [$product, $stock]) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"
                                                onclick="return confirm('¿Estas seguro de querer eliminar este stock?')"
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

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
@endpush