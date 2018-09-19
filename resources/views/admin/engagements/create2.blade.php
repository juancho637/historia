@extends('admin._layouts.main')

@section('title', config('app.name').' | Citas')

@section('header', 'Citas')

@section('description', 'Crear cita')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- jquery timepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/jquery-timepicker/jquery.timepicker.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css') }}">
    <style>
        @media (min-width: 1200px) {
            .box-engagement{
                position: fixed;
                width: 26%;
                padding: 0;
                margin: 0px 15px;
                right: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <form action="{{ route('engagements.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="col-xs-12 col-lg-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                                    <label for="client_id">Cliente:</label>
                                    <select name="client_id" id="client_id" class="form-control" style="width: 100%;"></select>
                                    {!! $errors->first('client_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div class="form-group">
                                    <label>Identificación:</label>
                                    <input type="text" id="identification" class="form-control" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Dirección:</label>
                                    <input type="text" id="address" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div class="form-group">
                                    <label>Correo eléctronico:</label>
                                    <input type="text" id="mail" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Celular:</label>
                                    <input type="text" id="cell_phone" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">Actualizar datos</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('pet_id') ? 'has-error' : '' }}">
                                    <label for="pet_id">Mascota:</label>
                                    <select name="pet_id" id="pet_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona una mascota</option>
                                    </select>
                                    {!! $errors->first('pet_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Raza:</label>
                                    <input type="text" id="breed" class="form-control" disabled/>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Edad:</label>
                                    <input type="text" id="years" class="form-control" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 box-engagement">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                        <label for="date">Fecha de la cita:</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input value="{{ old('date', Date('Y-m-d')) }}" name="date" type="text" class="form-control pull-right" id="datepicker">
                                        </div>
                                        {!! $errors->first('date', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 {{ $errors->has('services') ? 'has-error' : '' }}">
                                {!! $errors->first('services', '<span class="help-block">:message</span>') !!}
                                <div class="row">
                                    <div class="col-xs-7">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="consultation" name="services[]" class="flat-red" id="veterinary_consultation" @if(is_array(old('services')) && in_array('consultation', old('services'))) checked @endif>
                                                Consulta veterinaria
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="surgery" name="services[]" class="flat-red" id="surgery" @if(is_array(old('services')) && in_array('surgery', old('services'))) checked @endif>
                                                Cirugía
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-7">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="services" name="services[]" class="flat-red" id="medical_services" @if(is_array(old('services')) && in_array('services', old('services'))) checked @endif>
                                                Servicios médicos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="aesthetic" name="services[]" class="flat-red" id="aesthetic_services" @if(is_array(old('services')) && in_array('aesthetic', old('services'))) checked @endif>
                                                Estética
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="home_service" id="home_service" class="flat-red" @if(old('home_service')) checked @endif>
                                        Servicio a domicilio
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="engagement_to_be_confirmed" class="flat-red" @if(old('engagement_to_be_confirmed')) checked @endif>
                                        Cita por confirmar
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div style="height: 15px;"></div>
                                    <button type="submit" class="btn btn-primary btn-block">Guardar cita</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8" id="div_veterinary_consultation" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Consulta veterinaria</h3>
                        <div class="box-tools pull-right">
                            <div class="form-group">
                                <label style="margin-top: 3px; font-size: 18px; font-weight: 500;">
                                    <input type="checkbox" name="consultation_without_cost" class="flat-red" id="consultation_without_cost" @if(old('consultation_without_cost')) checked @endif>
                                    Consulta sin costo
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('users_veterinary_consultation') ? 'has-error' : '' }}">
                                    <label for="users_veterinary_consultation">Responsables asociados:</label>
                                    <select class="form-control select2" id="users_veterinary_consultation" multiple="multiple" name="users_veterinary_consultation[]" style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'consultation')
                                                    <option {{ collect(old('users_veterinary_consultation'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('users_veterinary_consultation', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div id="timer_content_veterinary_consultation">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('start_time_veterinary_consultation') ? 'has-error' : '' }}">
                                        <label for="start_time_veterinary_consultation">Hora inicial de la cita:</label>
                                        <input type="text" name="start_time_veterinary_consultation" id="start_time_veterinary_consultation" value="{{ old('start_time_veterinary_consultation') }}" class="start_time time start form-control" />
                                        {!! $errors->first('start_time_veterinary_consultation', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('end_time_veterinary_consultation') ? 'has-error' : '' }}">
                                        <label for="end_time_veterinary_consultation">Hora final de la cita:</label>
                                        <input type="text" name="end_time_veterinary_consultation" id="end_time_veterinary_consultation" value="{{ old('end_time_veterinary_consultation') }}" class="end_time time end form-control" />
                                        {!! $errors->first('end_time_veterinary_consultation', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12" id="div_consultation_without_cost" hidden>
                                <div class="form-group {{ $errors->has('reason_veterinary_consultation_without_cost') ? 'has-error' : '' }}">
                                    <label for="reason_veterinary_consultation_without_cost">Razón por la cual es sin costo:</label>
                                    <textarea type="text" name="reason_veterinary_consultation_without_cost" id="reason_veterinary_consultation_without_cost" class="form-control">{{ old('reason_veterinary_consultation_without_cost') }}</textarea>
                                    {!! $errors->first('reason_veterinary_consultation_without_cost', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description_veterinary_consultation') ? 'has-error' : '' }}">
                                    <label for="description_veterinary_consultation">Descripción:</label>
                                    <textarea type="text" name="description_veterinary_consultation" id="description_veterinary_consultation" class="form-control">{{ old('description_veterinary_consultation') }}</textarea>
                                    {!! $errors->first('description_veterinary_consultation', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8" id="div_medical_services" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Servicios médicos</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('users_medical_services') ? 'has-error' : '' }}">
                                    <label for="users_medical_services">Responsables asociados:</label>
                                    <select class="form-control select2" multiple="multiple" id="users_medical_services" name="users_medical_services[]" data-placeholder="Responsables"
                                            style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'services')
                                                    <option {{ collect(old('users_medical_services'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('users_medical_services', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div id="timer_content_medical_services">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('start_time_medical_services') ? 'has-error' : '' }}">
                                        <label for="start_time_medical_services">Hora inicial de la cita:</label>
                                        <input type="text" name="start_time_medical_services" id="start_time_medical_services" value="{{ old('start_time_medical_services') }}" class="start_time time start form-control" />
                                        {!! $errors->first('start_time_medical_services', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('end_time_medical_services') ? 'has-error' : '' }}">
                                        <label for="end_time_medical_services">Hora final de la cita:</label>
                                        <input type="text" name="end_time_medical_services" id="end_time_medical_services" value="{{ old('end_time_medical_services') }}" class="end_time time end form-control" />
                                        {!! $errors->first('end_time_medical_services', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('products_services') ? 'has-error' : '' }}">
                                    <label for="products_services">Productos:</label>
                                    <select name="products_services[]" multiple="multiple" id="products_services" data-placeholder="Productos" class="form-control" style="width: 100%;"></select>
                                    {!! $errors->first('products_services', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description_medical_services') ? 'has-error' : '' }}">
                                    <label for="description_medical_services">Descripción:</label>
                                    <textarea type="text" name="description_medical_services" id="description_medical_services" class="form-control">{{ old('description_medical_services') }}</textarea>
                                    {!! $errors->first('description_medical_services', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8" id="div_surgery" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Cirugía</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('users_surgery') ? 'has-error' : '' }}">
                                    <label for="users_surgery">Responsables:</label>
                                    <select class="form-control select2" multiple="multiple" name="users_surgery[]" data-placeholder="Responsables"
                                            style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'surgery')
                                                    <option {{ collect(old('users_surgery'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('users_surgery', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div id="timer_content_surgery">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('start_time_surgery') ? 'has-error' : '' }}">
                                        <label for="start_time_surgery">Hora inicial de la cita:</label>
                                        <input type="text" name="start_time_surgery" id="start_time_surgery" value="{{ old('start_time_surgery') }}" class="start_time time start form-control" />
                                        {!! $errors->first('start_time_surgery', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('end_time_surgery') ? 'has-error' : '' }}">
                                        <label for="end_time_surgery">Hora final de la cita:</label>
                                        <input type="text" name="end_time_surgery" id="end_time_surgery" value="{{ old('end_time_surgery') }}" class="end_time time end form-control" />
                                        {!! $errors->first('end_time_surgery', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('products_surgery') ? 'has-error' : '' }}">
                                    <label for="products_surgery">Productos:</label>
                                    <select name="products_surgery[]" multiple="multiple" id="products_surgery" data-placeholder="Productos" class="form-control" style="width: 100%;"></select>
                                    {!! $errors->first('products_surgery', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description_surgery') ? 'has-error' : '' }}">
                                    <label for="description_surgery">Descripción:</label>
                                    <textarea type="text" name="description_surgery" id="description_surgery" class="form-control">{{ old('description_surgery') }}</textarea>
                                    {!! $errors->first('description_surgery', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8" id="div_aesthetic_services" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Estética</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('users_aesthetic') ? 'has-error' : '' }}">
                                    <label for="users_aesthetic">Responsables:</label>
                                    <select class="form-control select2" multiple="multiple" name="users_aesthetic[]" id="users_aesthetic" data-placeholder="Responsables"
                                            style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'aesthetic')
                                                    <option {{ collect(old('users_aesthetic'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('users_aesthetic', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('description_aesthetic') ? 'has-error' : '' }}">
                                    <label for="description_aesthetic">Descripción:</label>
                                    <textarea type="text" name="description_aesthetic" id="description_aesthetic" class="form-control">{{ old('description_aesthetic') }}</textarea>
                                    {!! $errors->first('description_aesthetic', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('products_aesthetic') ? 'has-error' : '' }}">
                                    <label for="products_aesthetic">Productos:</label>
                                    <select name="products_aesthetic[]" multiple="multiple" id="products_aesthetic" data-placeholder="Productos" class="form-control" style="width: 100%;"></select>
                                    {!! $errors->first('products_aesthetic', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    <!-- datepair -->
    <script src="{{ asset('/plugins/datepair/dist/datepair.js') }}"></script>
    <script src="{{ asset('/plugins/datepair/dist/jquery.datepair.js') }}"></script>
    <!-- datepair -->
    <script src="{{ asset('/plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
    <!-- moment -->
    <script src="{{ asset('/plugins/moment/moment-with-locales.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>

    <script>
        $(function () {
            moment.locale("es");

            $('#home_service').on('ifToggled', function () {
                $('#timer_content_veterinary_consultation').fadeToggle();
                $('#timer_content_medical_services').fadeToggle();
                $('#timer_content_surgery').fadeToggle();
            });
            if($('#home_service').is(":checked")){
                $('#timer_content_veterinary_consultation').fadeToggle();
                $('#timer_content_medical_services').fadeToggle();
                $('#timer_content_surgery').fadeToggle();
            }

            $('#consultation_without_cost').on('ifToggled', function () {
                $('#div_consultation_without_cost').fadeToggle();
            });
            if($('#consultation_without_cost').is(":checked")){
                $('#div_consultation_without_cost').fadeToggle();
            }

            //Initialize variables
            let pets = [], clients = [];

            let pet_id = '{{ old('pet_id') }}';
            let client_id = '{{ old('client_id') }}';

            //Initialize Datemask2 Elements
            $('[data-mask]').inputmask();

            //Initialize Select2 Elements
            $('.select2').select2();

            $('#client_id').select2({
                minimumInputLength: 2,
                language: {
                    inputTooShort: function () {
                        return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                    }
                },
                ajax: {
                    url: "{{ route('api.clients.index') }}",
                    data: function (params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function (data, params) {
                        clients = data;
                        return {
                            results: data
                        };
                    },
                }
            });

            $('#products_services').select2({
                minimumInputLength: 2,
                language: {
                    inputTooShort: function () {
                        return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                    }
                },
                ajax: {
                    url: "{{ route('api.products.index') }}",
                    data: function (params) {
                        return {
                            search: params.term,
                            categories: ['pharmacy', 'services']
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                }
            });

            $('#products_surgery').select2({
                minimumInputLength: 2,
                language: {
                    inputTooShort: function () {
                        return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                    }
                },
                ajax: {
                    url: "{{ route('api.products.index') }}",
                    data: function (params) {
                        return {
                            search: params.term,
                            categories: ['services']
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                }
            });

            $('#products_aesthetic').select2({
                minimumInputLength: 2,
                language: {
                    inputTooShort: function () {
                        return "Por favor ingrese 2 o más letras para realizar la busqueda.";
                    }
                },
                ajax: {
                    url: "{{ route('api.products.index') }}",
                    data: function (params) {
                        return {
                            search: params.term,
                            categories: ['aesthetic']
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data
                        };
                    },
                }
            });

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd',
                startDate: new Date()
            });

            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            });

            //Initialize input widgets first
            $('.start_time').timepicker({
                step: 30,
                timeFormat: 'h:i a',
                scrollDefault: 'now'
            });
            $('.end_time').timepicker({
                step: 30,
                timeFormat: 'h:i a',
                showDuration: true
            });

            //Initialize datepair
            $('#timer_content_veterinary_consultation').datepair({
                defaultTimeDelta: 600000
            });

            $('#timer_content_medical_services').datepair({
                defaultTimeDelta: 600000
            });

            $('#timer_content_surgery').datepair({
                defaultTimeDelta: 600000
            });

            //Code
            if(client_id){
                $.get('{{ route('api.clients.show', old('client_id')) }}', function(client) {
                    $('#client_id').append(`<option value="{{ old('client_id') }}" selected>${client.text}</option>`);
                    $('#address').attr('disabled', false);
                    $('#mail').attr('disabled', false);
                    $('#cell_phone').attr('disabled', false);
                    setFields(client);
                });
            }

            $('#client_id').change(function() {
                $('#address').attr('disabled', false);
                $('#mail').attr('disabled', false);
                $('#cell_phone').attr('disabled', false);
                clients.map((client)=>{
                    if(client.id === parseInt($(this).val())){
                        setFields(client);
                    }
                });
            });

            function setFields(client) {
                pets = client.pets;
                $('#identification').val(client.type_identification+'. '+client.identification);
                $('#address').val(client.address);
                $('#cell_phone').val(client.cell_phone);
                $('#mail').val(client.email);

                let oldPet = parseInt({{ old('pet_id') }});

                $('#pet_id').empty();
                $('#breed').val('');
                $('#years').val('');
                $('#pet_id').append(`<option value="" selected>Selecciona una mascota</option>`);
                pets.map((pet)=>{
                    $('#pet_id').append(`<option value="${pet.id}" title="${pet.breed.name}" ${oldPet === pet.id ? 'selected' : ''}>${pet.name}</option>`);
                    if (oldPet === pet.id){
                        $('#breed').val(pet.breed.name);
                        $('#years').val(moment(pet.birth_date, "YYYYMMDD").fromNow(true));
                    }
                });
            }

            $('#pet_id').change(function() {
                pets.map((pet)=>{
                    if($(this).val() === ''){
                        $('#breed').val('');
                        $('#years').val('');
                    }

                    if(pet.id === parseInt($(this).val())){
                        $('#breed').val(pet.breed.name);
                        $('#years').val(moment(pet.birth_date, "YYYYMMDD").fromNow(true));
                    }
                });
            });

            $('#veterinary_consultation').on('ifToggled', function () {
                $('#div_veterinary_consultation').fadeToggle();
            });
            if($('#veterinary_consultation').is(":checked")){
                $('#div_veterinary_consultation').fadeIn();
            }

            $('#surgery').on('ifToggled', function () {
                $('#div_surgery').fadeToggle();
            });
            if($('#surgery').is(":checked")){
                $('#div_surgery').fadeIn();
            }

            $('#medical_services').on('ifToggled', function () {
                $('#div_medical_services').fadeToggle();
            });
            if($('#medical_services').is(":checked")){
                $('#div_medical_services').fadeIn();
            }

            $('#aesthetic_services').on('ifToggled', function () {
                $('#div_aesthetic_services').fadeToggle();
            });
            if($('#aesthetic_services').is(":checked")){
                $('#div_aesthetic_services').fadeIn();
            }
        });
    </script>
@endpush