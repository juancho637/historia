@extends('admin._layouts.main')

@section('title', config('app.name').' | Proveedores')

@section('header', 'Proveedores')

@section('description', 'Crear proveedor')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('providers.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">Nombre:</label>
                                    <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Nombres">
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description">Descripción:</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Descripción">{{ old('description') }}</textarea>
                                    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Guardar Proveedor</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection