@extends('admin._layouts.main')

@section('title', config('app.name').' | Usuarios')

@section('header', 'Usuarios')

@section('description', 'Editar usuario')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <form action="{{ route('users.update', $user) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-sm-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">Nombres:</label>
                                    <input value="{{ old('name', $user->name) }}" type="text" class="form-control" name="name" id="name" placeholder="Nombres">
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label for="last_name">Apellidos:</label>
                                    <input value="{{ old('last_name', $user->last_name) }}" type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellidos">
                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('identification') ? 'has-error' : '' }}">
                                    <label for="identification">Cédula:</label>
                                    <input value="{{ old('identification', $user->identification) }}" type="number" class="form-control" name="identification" id="identification" placeholder="Cédula">
                                    {!! $errors->first('identification', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="address">Dirección:</label>
                                    <input value="{{ old('address', $user->address) }}" type="text" class="form-control" name="address" id="address" placeholder="Dirección">
                                    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">Correo electrónico:</label>
                                    <input value="{{ old('email', $user->email) }}" type="text" class="form-control" name="email" id="email" placeholder="Correo electrónico">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group {{ $errors->has('cell_phone') ? 'has-error' : '' }}">
                                    <label for="cell_phone">Celular:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <input value="{{ old('cell_phone', $user->cell_phone) }}" type="text" class="form-control" id="cell_phone" name="cell_phone" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    </div>
                                    {!! $errors->first('cell_phone', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="phone">Telefono:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input value="{{ old('phone', $user->phone) }}" type="text" class="form-control" name="phone" id="phone" data-inputmask='"mask": "999-9999"' data-mask>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($user->id === Auth::user()->id)
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('old_password') ? 'has-error' : '' }}">
                                        <label for="name">Antigua contraseña:</label>
                                        <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Antigua contraseña">
                                        {!! $errors->first('old_password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="password">Nueva contraseña:</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Nueva contraseña">
                                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label for="identification">Confirmación de contraseña:</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirmación de contraseña">
                                        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('occupation_id') ? 'has-error' : '' }}">
                                    <label for="occupation_id">Cargo:</label>
                                    <select name="occupation_id" id="occupation_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona un cargo</option>
                                        @foreach($occupations as $occupation )
                                            <option value="{{ $occupation->id }}" {{ old('occupation_id', $user->occupation_id) == $occupation->id ? 'selected' : '' }}>{{ $occupation->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('occupation_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                                    <label for="description">Servicios:</label>
                                    <select class="form-control select2" multiple="multiple" name="services[]" id="categories" data-placeholder="Seleccione por lo menos un servicio"
                                            style="width: 100%;">
                                        @foreach($services as $service)
                                            <option {{ collect(old('services', $user->services->pluck('id')))->contains($service->id) ? 'selected' : '' }} value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('services', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="professional_identification">Tarjeta profesional:</label>
                                    <input value="{{ old('professional_identification', $user->professional_identification) }}" type="number" class="form-control" name="professional_identification" id="professional_identification" placeholder="Tarjeta profesional">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Actualizar Usuario</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <!-- InputMask -->
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Datemask2 Elements
            $('[data-mask]').inputmask();

            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endpush