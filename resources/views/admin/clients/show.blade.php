@extends('admin._layouts.main')

@section('title', config('app.name').' | Clientes/Mascotas')

@section('header', 'Clientes/Mascotas')

@section('description', 'Visualizar cliente')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label for="name">Nombre completo:</label>
                            <input value="{{ $client->full_name }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Tipo de identificación:</label>
                            <input value="{{ $client->type_identification === 'CC' ? 'Cédula de ciudadania' : (($client->type_identification === 'CE') ? 'Cédula extranjera' : 'Tarjeta de identidad') }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Numero de identificación:</label>
                            <input value="{{ $client->identification }}" type="number" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Género:</label>
                            <input value="{{ $client->gender === 'M' ? 'Masculino' : 'Femenino'}}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="form-group">
                            <label for="address">Dirección:</label>
                            <input value="{{ $client->address }}" type="text" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input value="{{ $client->email }}" type="email" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="birth_date">Fecha de nacimiento:</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input value="{{ $client->birth_date }}" type="text" class="form-control pull-right" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="cell_phone">Celular:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <input value="{{ $client->cell_phone }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label>Telefono:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input value="{{ $client->phone }}" type="text" class="form-control" data-inputmask='"mask": "999-9999"' data-mask disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning btn-block">Editar cliente</a>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Listado de mascotas asociadas</h3>

                <div class="pull-right box-tools">
                    <a type="button" class="btn btn-primary btn-sm" href="{{ route('clients.pets.create', $client) }}">
                        <i class="fa fa-plus"></i> Nueva mascota
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <th>Peso</th>
                            <th>Fecha de nacimiento</th>
                            <th>Estado reproductivo</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($client->pets as $pet)
                            <tr>
                                <td>{{ $pet->name }}</td>
                                <td>
                                    @if($pet->gender == 'M')
                                        Macho
                                    @else
                                        Hembra
                                    @endif
                                </td>
                                <td>{{ $pet->weight }} Kg</td>
                                <td>{{ $pet->birth_date }}</td>
                                <td>{{ $pet->reproductive_status }}</td>
                                <td>{{ $pet->breed->species->name }}</td>
                                <td>{{ $pet->breed->name }}</td>
                                <td>{{ $pet->state->name }}</td>
                                @if(isset($pet->deleted_at))
                                    <td>
                                        <a href="#" class="btn btn-xs btn-info">Restaurar mascota</a>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('clients.pets.edit', [$client, $pet]) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                        <form method="POST" action="{{ route('clients.pets.destroy', [$pet->client, $pet]) }}" style="display: inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit"
                                                    onclick="return confirm('¿Estas seguro de querer eliminar esta mascota?')"
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
            $('.select2').select2();

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush