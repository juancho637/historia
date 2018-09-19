@extends('admin._layouts.main')

@section('title', config('app.name').' | Clientes/Mascotas')

@section('header', 'Clientes/Mascotas')

@section('description', 'Editar Mascota')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('clients.pets.update', [$client, $pet]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">Nombre:</label>
                                    <input value="{{ old('name', $pet->name) }}" type="text" class="form-control" name="name" id="name" placeholder="Nombre">
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                                    <label for="weight">Peso (Kg):</label>
                                    <input  step="any" value="{{ old('weight', $pet->weight) }}" type="number" class="form-control" name="weight" id="weight" placeholder="Peso (Kg)">
                                    {!! $errors->first('weight', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                    <label for="gender">Género:</label>
                                    <select name="gender" id="gender" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona un tipo de sexo</option>
                                        <option value="M" @if (old('gender', $pet->gender) == "M") {{ 'selected' }} @endif>Macho</option>
                                        <option value="F" @if (old('gender', $pet->gender) == "F") {{ 'selected' }} @endif>Hembra</option>
                                    </select>
                                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }}">
                                    <label for="birth_date">Fecha de nacimiento:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input value="{{ old('birth_date', $pet->birth_date) }}" name="birth_date" type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                    {!! $errors->first('birth_date', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('species_id') ? 'has-error' : '' }}">
                                    <label for="species_id">Especie:</label>
                                    <select name="species_id" id="species_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona una especie</option>
                                        @foreach($species as $kind)
                                            <option value="{{ $kind->id }}" {{ old('species_id', $pet->breed->species_id) == $kind->id ? 'selected' : '' }}>{{ $kind->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('species_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('breed_id') ? 'has-error' : '' }}">
                                    <label for="breed_id">Raza:</label>
                                    <select name="breed_id" id="breed_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona una raza</option>
                                    </select>
                                    {!! $errors->first('breed_id', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group {{ $errors->has('reproductive_status') ? 'has-error' : '' }}">
                                    <label for="reproductive_status">Estado reproductivo:</label>
                                    <select name="reproductive_status" id="reproductive_status" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Selecciona un estado reproductivo</option>
                                        <option value="REPRODUCTIVO" @if (old('reproductive_status', $pet->reproductive_status) == "REPRODUCTIVO") {{ 'selected' }} @endif>Reproductivo</option>
                                        <option value="CASTRADO" @if (old('reproductive_status', $pet->reproductive_status) == "CASTRADO") {{ 'selected' }} @endif>Castrado</option>
                                    </select>
                                    {!! $errors->first('reproductive_status', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Actulizar mascota</button>
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
    <!-- DataTables -->
    <script src="{{ asset('/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

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

            //Data table
            $('#pets-table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });

            //Code
            if($('#species_id').val() !== ''){
                getBreeds($('#species_id').val());
            }

            $('#species_id').change((event)=>{
                if(event.target.value !== ''){
                    getBreeds(event.target.value);
                }else{
                    $('#breed_id').empty();
                    $('#breed_id').append(`<option value="" selected>Selecciona una raza</option>`);
                }
            });

            function getBreeds(species_id) {
                let url = '{{ route("species.breeds.index", ":species_id") }}';
                url = url.replace(':species_id', species_id);
                let oldBreed = parseInt({{ old('breed_id', $pet->breed_id) }});
                $.get(url, (response)=>{
                    $('#breed_id').empty();
                    response.forEach((breed)=>{
                        $('#breed_id').append(`<option value="${breed.id}"  ${oldBreed === breed.id ? 'selected' : ''}>${breed.name}</option>`);
                    });
                });
            }
        });
    </script>
@endpush