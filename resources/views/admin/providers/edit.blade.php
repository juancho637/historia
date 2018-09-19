@extends('admin._layouts.main')

@section('title', config('app.name').' | Proveedores')

@section('header', 'Proveedores')

@section('description', 'Editar proveedor')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('providers.update', $provider) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">Nombre:</label>
                                    <input value="{{ old('name', $provider->name) }}" type="text" class="form-control" name="name" id="name" placeholder="Nombres">
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description">Descripción:</label>
                                    <textarea class="form-control" name="description" id="description" placeholder="Descripción">{{ old('description', $provider->description) }}</textarea>
                                    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Actualizar proveedor</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection