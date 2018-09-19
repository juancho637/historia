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
                                        <label for="datepicker">Fecha de la cita:</label>
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
            <div class="col-xs-12 col-lg-8" id="div_veterinary_consultation" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Consulta veterinaria</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.consultation.users') ? 'has-error' : '' }}">
                                    <label for="users_consultation">Responsables asociados:</label>
                                    <select class="form-control select2" id="users_consultation" multiple="multiple" name="details[consultation][users][]" style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'consultation')
                                                    <option {{ collect(old('details.consultation.users'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('details.consultation.users', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div id="timer_content_veterinary_consultation">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('details.consultation.start_time') ? 'has-error' : '' }}">
                                        <label for="start_time_consultation">Hora inicial de la cita:</label>
                                        <input type="text" name="details[consultation][start_time]" id="start_time_consultation" value="{{ old('details.consultation.start_time') }}" class="start_time time start form-control" />
                                        {!! $errors->first('details.consultation.start_time', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('details.consultation.end_time') ? 'has-error' : '' }}">
                                        <label for="end_time_consultation">Hora final de la cita:</label>
                                        <input type="text" name="details[consultation][end_time]" id="end_time_consultation" value="{{ old('details.consultation.end_time') }}" class="end_time time end form-control" />
                                        {!! $errors->first('details.consultation.end_time', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.consultation.products') ? 'has-error' : '' }}">
                                    <label for="products_consultation">Tipo de consulta:</label>
                                    <select class="form-control select2" id="products_consultation" name="details[consultation][products][]" style="width: 100%;">
                                        @foreach($consultations as $consultation)
                                            <option {{ collect(old('details.consultation.products'))->contains($consultation->id) ? 'selected' : '' }} value="{{ $consultation->id }}">{{ $consultation->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('details.consultation.products', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12" id="div_consultation_without_cost" hidden>
                                <div class="form-group {{ $errors->has('details.consultation.without_cost') ? 'has-error' : '' }}">
                                    <label for="reason_consultation_without_cost">Razón por la cual es sin costo:</label>
                                    <textarea name="details[consultation][without_cost]" id="reason_consultation_without_cost" class="form-control">{{ old('details.consultation.without_cost') }}</textarea>
                                    {!! $errors->first('details.consultation.without_cost', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.consultation.description') ? 'has-error' : '' }}">
                                    <label for="description_consultation">Descripción:</label>
                                    <textarea name="details[consultation][description]" id="description_consultation" class="form-control">{{ old('details.consultation.description') }}</textarea>
                                    {!! $errors->first('details.consultation.description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-8" id="div_medical_services" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Servicios médicos</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.services.users') ? 'has-error' : '' }}">
                                    <label for="users_services">Responsables asociados:</label>
                                    <select class="form-control select2" multiple="multiple" id="users_services" name="details[services][users][]" style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'services')
                                                    <option {{ collect(old('details.services.users'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('details.services.users', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div id="timer_content_medical_services">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('details.services.start_time') ? 'has-error' : '' }}">
                                        <label for="start_time_services">Hora inicial de la cita:</label>
                                        <input type="text" name="details[services][start_time]" id="start_time_services" value="{{ old('details.services.start_time') }}" class="start_time time start form-control" />
                                        {!! $errors->first('details.services.start_time', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('details.services.end_time') ? 'has-error' : '' }}">
                                        <label for="end_time_services">Hora final de la cita:</label>
                                        <input type="text" name="details[services][end_time]" id="end_time_services" value="{{ old('details.services.end_time') }}" class="end_time time end form-control" />
                                        {!! $errors->first('details.services.end_time', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.services.products') ? 'has-error' : '' }}">
                                    <label for="products_services">Productos:</label>
                                    <select name="details[services][products][]" multiple="multiple" id="products_services" class="form-control" style="width: 100%;">
                                        @if (is_array(old('details.services.products')))
                                            @foreach (old('details.services.products') as $product)
                                                <option value="{{ $product }}" selected="selected">{{ \App\Product::where('id', $product)->first()->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {!! $errors->first('details.services.products', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.services.description') ? 'has-error' : '' }}">
                                    <label for="description_services">Descripción:</label>
                                    <textarea name="details[services][description]" id="description_services" class="form-control">{{ old('details.services.description') }}</textarea>
                                    {!! $errors->first('details.services.description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-8" id="div_surgery" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Cirugía</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.surgery.users') ? 'has-error' : '' }}">
                                    <label for="users_surgery">Responsables:</label>
                                    <select class="form-control select2" id="users_surgery" multiple="multiple" name="details[surgery][users][]" style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'surgery')
                                                    <option {{ collect(old('details.surgery.users'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('details.surgery.users', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div id="timer_content_surgery">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('details.surgery.start_time') ? 'has-error' : '' }}">
                                        <label for="start_time_surgery">Hora inicial de la cita:</label>
                                        <input type="text" name="details[surgery][start_time]" id="start_time_surgery" value="{{ old('details.surgery.start_time') }}" class="start_time time start form-control" />
                                        {!! $errors->first('details.surgery.start_time', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('details.surgery.end_time') ? 'has-error' : '' }}">
                                        <label for="end_time_surgery">Hora final de la cita:</label>
                                        <input type="text" name="details[surgery][end_time]" id="end_time_surgery" value="{{ old('details.surgery.end_time') }}" class="end_time time end form-control" />
                                        {!! $errors->first('details.surgery.end_time', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.surgery.products') ? 'has-error' : '' }}">
                                    <label for="products_surgery">Productos:</label>
                                    <select name="details[surgery][products][]" multiple="multiple" id="products_surgery" class="form-control" style="width: 100%;">
                                        @if (is_array(old('details.surgery.products')))
                                            @foreach (old('details.surgery.products') as $product)
                                                <option value="{{ $product }}" selected="selected">{{ \App\Product::where('id', $product)->first()->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {!! $errors->first('details.surgery.products', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.surgery.description') ? 'has-error' : '' }}">
                                    <label for="description_surgery">Descripción:</label>
                                    <textarea name="details[surgery][description]" id="description_surgery" class="form-control">{{ old('details.surgery.description') }}</textarea>
                                    {!! $errors->first('details.surgery.description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-lg-8" id="div_aesthetic_services" hidden>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Estética</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.aesthetic.users') ? 'has-error' : '' }}">
                                    <label for="users_aesthetic">Responsables:</label>
                                    <select class="form-control select2" multiple="multiple" name="details[aesthetic][users][]" id="users_aesthetic" style="width: 100%;">
                                        @foreach($users as $user)
                                            @foreach($user->services as $service)
                                                @if($service->abbreviation === 'aesthetic')
                                                    <option {{ collect(old('details.aesthetic.users'))->contains($user->id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->full_name }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                    {!! $errors->first('details.aesthetic.users', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.aesthetic.description') ? 'has-error' : '' }}">
                                    <label for="description_aesthetic">Descripción:</label>
                                    <textarea name="details[aesthetic][description]" id="description_aesthetic" class="form-control">{{ old('details.aesthetic.description') }}</textarea>
                                    {!! $errors->first('details.aesthetic.description', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group {{ $errors->has('details.aesthetic.products') ? 'has-error' : '' }}">
                                    <label for="products_aesthetic">Productos:</label>
                                    <select name="details[aesthetic][products][]" multiple="multiple" id="products_aesthetic" class="form-control" style="width: 100%;">
                                        @if (is_array(old('details.aesthetic.products')))
                                            @foreach (old('details.aesthetic.products') as $product)
                                                <option value="{{ $product }}" selected="selected">{{ \App\Product::where('id', $product)->first()->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    {!! $errors->first('details.aesthetic.products', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="bigotes" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('bigotes', old('details.aesthetic.add'))) checked @endif>
                                                Bigotes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="carita bajita" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('carita bajita', old('details.aesthetic.add'))) checked @endif>
                                                Carita bajita
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="carita pelada" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('carita pelada', old('details.aesthetic.add'))) checked @endif>
                                                Carita pelada
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corbatin" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corbatin', old('details.aesthetic.add'))) checked @endif>
                                                Corbatin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte bajito" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte bajito', old('details.aesthetic.add'))) checked @endif>
                                                Corte bajito
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte bebé" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte bebé', old('details.aesthetic.add'))) checked @endif>
                                                Corte bebé
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte cocker spaniel" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte cocker spaniel', old('details.aesthetic.add'))) checked @endif>
                                                Corte cocker spaniel
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte de uñas" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte de uñas', old('details.aesthetic.add'))) checked @endif>
                                                Corte de uñas
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte FP 1/2 parejo" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte FP 1/2 parejo', old('details.aesthetic.add'))) checked @endif>
                                                Corte FP 1/2 parejo
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte FP campo y ciudad" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte FP campo y ciudad', old('details.aesthetic.add'))) checked @endif>
                                                Corte FP campo y ciudad
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte FP perjo pulido" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte FP perjo pulido', old('details.aesthetic.add'))) checked @endif>
                                                Corte FP perjo pulido
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte FP pelado" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte FP pelado', old('details.aesthetic.add'))) checked @endif>
                                                Corte FP pelado
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte schnauzer" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte schnauzer', old('details.aesthetic.add'))) checked @endif>
                                                Corte schnauzer
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="corte terrier" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('corte terrier', old('details.aesthetic.add'))) checked @endif>
                                                Corte terrier
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="despejar cara" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('despejar cara', old('details.aesthetic.add'))) checked @endif>
                                                Despejar cara
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="despejar genitales" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('despejar genitales', old('details.aesthetic.add'))) checked @endif>
                                                Despejar genitales
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="guantes" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('guantes', old('details.aesthetic.add'))) checked @endif>
                                                Guantes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="drenar adanales" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('drenar adanales', old('details.aesthetic.add'))) checked @endif>
                                                Drenar adanales
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="huellitas" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('huellitas', old('details.aesthetic.add'))) checked @endif>
                                                Huellitas
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="moños" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('moños', old('details.aesthetic.add'))) checked @endif>
                                                Moños
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="pintar uñas" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('pintar uñas', old('details.aesthetic.add'))) checked @endif>
                                                Pintar uñas
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="ponpones" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('ponpones', old('details.aesthetic.add'))) checked @endif>
                                                Ponpones
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" value="aplicar loción" name="details[aesthetic][add][]" class="flat-red" @if(is_array(old('details.aesthetic.add')) && in_array('aplicar loción', old('details.aesthetic.add'))) checked @endif>
                                                Aplicar loción
                                            </label>
                                        </div>
                                    </div>
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

            $('#products_consultation').on('change', function () {
                if($("#products_consultation option:selected").text() === 'Consulta sin costo'){
                    $('#div_consultation_without_cost').fadeIn();
                }else{
                    $('#div_consultation_without_cost').fadeOut();
                }
            });

            if($("#products_consultation option:selected").text() === 'Consulta sin costo'){
                $('#div_consultation_without_cost').fadeIn();
            }

            //Initialize variables
            let pets = [], clients = [];
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
                            category: 'services'
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
                            category: 'surgery'
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
                            category: 'aesthetic'
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
                defaultTimeDelta: 1800000
            });

            $('#timer_content_medical_services').datepair({
                defaultTimeDelta: 1800000
            });

            $('#timer_content_surgery').datepair({
                defaultTimeDelta: 1800000
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