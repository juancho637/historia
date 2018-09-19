@extends('admin._layouts.main')

@section('title', config('app.name').' | Usuarios')

@section('header', 'Usuarios')

@section('description', 'Visualizar usuario')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="name">Nombres:</label>
                                <input value="{{ $user->name }}" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="last_name">Apellidos:</label>
                                <input value="{{ $user->last_name }}" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="identification">Cédula:</label>
                                <input value="{{ $user->identification }}" type="number" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="address">Dirección:</label>
                                <input value="{{ $user->address }}" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Correo electrónico:</label>
                                <input value="{{ $user->email }}" type="text" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Celular:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-mobile"></i>
                                    </div>
                                    <input value="{{ $user->cell_phone }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Telefono:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input value="{{ $user->phone }}" type="text" class="form-control" data-inputmask='"mask": "999-9999"' data-mask disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Cargo:</label>
                                <input value="{{ $user->occupation->name }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="description">Servicios:</label>
                                <select class="form-control select2" multiple="multiple" id="categories" data-placeholder="Seleccione por lo menos un servicio"
                                        style="width: 100%;" disabled>
                                    @foreach($services as $service)
                                        <option {{ collect($user->services->pluck('id'))->contains($service->id) ? 'selected' : '' }} value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Tarjeta profesional:</label>
                                <input value="{{ $user->professional_identification }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-block">Editar usuario</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <script>
        $(function () {
            //Initialize Datemask2 Elements
            $('[data-mask]').inputmask();

            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endpush