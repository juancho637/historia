@extends('admin._layouts.main')

@section('title', config('app.name').' | Productos/Servicios')

@section('header', 'Productos/Servicios')

@section('description', 'Crear stock')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('products.stocks.store', $product) }}" method="POST">
                {{ csrf_field() }}
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <div class="form-group {{ $errors->has('purchase_amount') ? 'has-error' : '' }}">
                                    <label for="purchase_amount">Monto comprado:</label>
                                    <input value="{{ old('purchase_amount') }}" type="number" class="form-control" name="purchase_amount" id="purchase_amount" placeholder="Monto comprado">
                                    {!! $errors->first('purchase_amount', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="form-group {{ $errors->has('stock_min') ? 'has-error' : '' }}">
                                    <label for="weight">Stock mínimo:</label>
                                    <input value="{{ old('stock_min') }}" type="number" class="form-control" name="stock_min" id="stock_min" placeholder="Stock mínimo">
                                    {!! $errors->first('stock_min', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <div class="form-group {{ $errors->has('lot') ? 'has-error' : '' }}">
                                    <label for="lot">Número de lote:</label>
                                    <input value="{{ old('lot') }}" type="number" class="form-control" name="lot" id="lot" placeholder="Número de lote">
                                    {!! $errors->first('lot', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">
                                    <label for="due_date">Fecha de caducidad:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input value="{{ old('due_date') }}" name="due_date" id="due_date" type="text" class="form-control pull-right">
                                    </div>
                                    {!! $errors->first('due_date', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group {{ $errors->has('provider_id') ? 'has-error' : '' }}">
                                    <label for="provider_id">Proveedor:</label>
                                    <select name="provider_id" id="provider_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Seleccione un proveedor</option>
                                        @foreach($product->providers as $provider )
                                            <option value="{{ $provider->id }}" {{ old('provider_id') == $provider->id ? 'selected' : '' }}>{{ $provider->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('provider_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Guardar stock</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('#due_date').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush