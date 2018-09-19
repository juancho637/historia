@extends('admin._layouts.main')

@section('title', config('app.name').' | Clientes/Mascotas')

@section('header', 'Clientes/Mascotas')

@section('description', 'Crear cliente')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('clients.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group {{ $errors->has('full_name') ? 'has-error' : '' }}">
                                    <label for="full_name">Nombre completo:</label>
                                    <input value="{{ old('full_name') }}" type="text" class="form-control" name="full_name" id="full_name" placeholder="Nombre completo">
                                    {!! $errors->first('full_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            {{-- <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                    <label for="last_name">Apellidos:</label>
                                    <input value="{{ old('last_name') }}" type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellidos">
                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div> --}}
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('type_identification') ? 'has-error' : '' }}">
                                    <label for="type_identification">Tipo de identificación:</label>
                                    <select name="type_identification" id="type_identification" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona un tipo de identificación</option>
                                        <option value="CC" @if (old('type_identification') == "CC") {{ 'selected' }} @endif>Cédula de ciudadania</option>
                                        <option value="CE" @if (old('type_identification') == "CE") {{ 'selected' }} @endif>Cédula extranjera</option>
                                        <option value="TI" @if (old('type_identification') == "TI") {{ 'selected' }} @endif>Tarjeta de identidad</option>
                                    </select>
                                    {!! $errors->first('type_identification', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('identification') ? 'has-error' : '' }}">
                                    <label for="identification">Numero de identificación:</label>
                                    <input value="{{ old('identification') }}" type="number" class="form-control" name="identification" id="identification" placeholder="Número de identificación">
                                    {!! $errors->first('identification', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                    <label for="gender">Género:</label>
                                    <select name="gender" id="gender" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona un tipo de sexo</option>
                                        <option value="M" @if (old('gender') == "M") {{ 'selected' }} @endif>Masculino</option>
                                        <option value="F" @if (old('gender') == "F") {{ 'selected' }} @endif>Femenino</option>
                                    </select>
                                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="address">Dirección:</label>
                                    <input value="{{ old('address') }}" type="text" class="form-control" name="address" id="address" placeholder="Dirección">
                                    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">Correo electrónico:</label>
                                    <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico">
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }}">
                                    <label for="birth_date">Fecha de nacimiento:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input value="{{ old('birth_date') }}" name="birth_date" type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                    {!! $errors->first('birth_date', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('cell_phone') ? 'has-error' : '' }}">
                                    <label for="cell_phone">Celular:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-mobile"></i>
                                        </div>
                                        <input value="{{ old('cell_phone') }}" type="text" class="form-control" id="cell_phone" name="cell_phone" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                    </div>
                                    {!! $errors->first('cell_phone', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="phone">Telefono:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input value="{{ old('phone') }}" type="text" class="form-control" name="phone" id="phone" data-inputmask='"mask": "999-9999"' data-mask>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Guardar cliente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- InputMask -->
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" charset="UTF-8"></script>
    <script src="{{ asset('/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Datemask2 Elements
            $('[data-mask]').inputmask();

            //Initialize Select2 Elements
            $('.select2').select2()

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd'
            })
        });
    </script>
@endpush