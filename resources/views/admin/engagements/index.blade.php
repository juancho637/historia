@extends('admin._layouts.main')

@section('title', config('app.name').' | Citas')

@section('header', 'Citas')

@push('styles')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/fullcalendar.print.min.css') }}" media="print">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css') }}">
<!-- daterange picker -->
{{--<link rel="stylesheet" href="{{ asset('plugins/bootstrap-daterangepicker/daterangepicker.css') }}">--}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .custom-margin{
        margin: 0 1px;
    }
    .select2-dropdown{
        z-index: 900 !important;
    }
    .label{
        font-weight: 400 !important;
        letter-spacing: .6px !important;
    }
    .row{
        margin-left: -5px;
        margin-right: -5px;
        margin-top: 15px;
    }
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
    h2{
        margin: 0 0;
    }
</style>
@endpush

@section('description', 'Página para gestión de citas')

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Calendario de citas</h3>
            <div class="box-tools pull-right">
                <a type="button" class="btn btn-primary btn-sm" href="{{ route('engagements.create') }}">
                    <i class="fa fa-plus"></i> Nueva cita
                </a>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <select name="user_id" id="user_id" class="form-control select2" required="required" style="width: 100%">
                        <option value="" selected>Todos los usuarios</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" >{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <select name="service_id" id="service_id" class="form-control select2" required="required" style="width: 100%">
                        <option value="" selected>Todos los servicios</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" >{{ ucfirst($service->name) }}</option>
                        @endforeach
                        <option value="homeService">Domicilios</option>
                    </select>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <input type="text" name="client" id="client" class="form-control" placeholder="cliente" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="btn-back">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            </button>
                        </span>
                        <input type="text" class="form-control pull-right" id="date" name="date">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="btn-next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default" id="btn-today">hoy</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2 col-md-offset-4">
                    <button class="btn btn-default btn-block" role="button" id="search-appointment">
                        Buscar cita
                    </button>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-2">
                    <button class="btn btn-default btn-block" role="button" id="clear">
                        Borrar busqueda
                    </button>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Cliente</th>
                        <th>Mascota</th>
                        <th>Servicios</th>
                        <th>T. Estética</th>
                        <th>T. Domicilio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="data-engagements">
                @php($engagementCalendarSearch = false)
                @include('admin.engagements.partials.trEngagementTemplate', compact('engagement', 'engagementCalendarSearch'))
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- moment -->
    <script src="{{ asset('/plugins/moment/moment.js') }}"></script>
    <!-- fullCalendar -->
    <script src="{{ asset('/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('/plugins/fullcalendar/locale/es.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- date-range-picker -->
    {{--<script src="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>--}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- Code -->
    <script>
        $(function () {
            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            //Date range picker
            $('#date').daterangepicker({
                autoApply: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $('#date').change(function () {
                let dates = $(this).val().split(' - ');
                if(dates[0] !== dates[1]){
                    $('#btn-back, #btn-next').attr('disabled', true);
                }else{
                    $('#btn-back, #btn-next').attr('disabled', false);
                }
            });

            //Initialize Popover & Tooltip Elements
            $(document).on('DOMNodeInserted', function () {
                $('[data-toggle="tooltip"]').tooltip();

                $('[data-toggle="popover"]').popover({
                    placement: 'auto bottom',
                    html: true,
                    container: 'body'
                });
            });

            $('[role="button"]').on('click', function () {
                $('.popover').popover('hide');
            });

            $(document).on('click', function (e) {
                $('[data-toggle="popover"], [data-original-title]').each(function () {
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                        (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
                    }
                });
            });

            //Initialize Select2 Elements
            $('.select2').select2();

            //Code
            $('#clear').click(()=>{
                $('#user_id').val('').trigger('change');
                $('#service_id').val('').trigger('change');
                $('#client').val('');

                let date = new Date().toISOString().split('T')[0];

                $('#date').data('daterangepicker').setStartDate(date);
                $('#date').data('daterangepicker').setEndDate(date);

                $.ajax({
                    url: '{{ route('api.engagements.index') }}',
                    type: 'GET',
                    data:{
                        type: 'engagementCalendar',
                        action: 'today',
                    },
                    success: function(response) {
                        $('#data-engagements').html(response);
                    }
                });
            });

            $('#search-appointment').click(()=>{
                $.ajax({
                    url: '{{ route('api.engagements.index') }}',
                    type: 'GET',
                    data:{
                        type: 'engagementCalendarSearch',
                        dates: $('#date').val(),
                        user_id: $('#user_id').val(),
                        service_id: $('#service_id').val(),
                        client: $('#client').val(),
                    },
                    success: function(response) {
                        $('#data-engagements').html(response);
                    }
                });
            });

            $(document).on("click", "#acces", function(){
                alert ($(this).attr('id'));
            });

            $(document).on("click", "#noacces", function(){
                alert ($(this).attr('id'));
            });

            $(document).on("click", ".btn-assist", function(){
                changeStateAppointment($(this).attr('ref'), 'appoint-atten');
            });

            $(document).on("click", ".btn-undo-assist", function(){
                changeStateAppointment($(this).attr('ref'), 'gen-act');
            });

            $(document).on("click", ".btn-not-assist", function(){
                changeStateAppointment($(this).attr('ref'), 'appoint-noatten');
            });

            $(document).on("click", ".btn-cancel", function(){
                let newVal = prompt('Motivo por el cual desea eliminar la cita');
                if (newVal === "") {
                    while (newVal === ''){
                        newVal = prompt('Motivo por el cual desea eliminar la cita');
                    }
                    if (newVal){
                        changeStateAppointment($(this).attr('ref'), 'appoint-canceled', newVal);

                    }
                } else if (newVal){
                    changeStateAppointment($(this).attr('ref'), 'appoint-canceled', newVal);
                }
            });

            function changeStateAppointment(ref, state, reason = null) {

                if(state !== 'appoint-canceled'){
                    $.ajax({
                        url: '{{ url('api/engagements') }}/'+ref,
                        type: 'PATCH',
                        data:{
                            state: state,
                            type: 'updateEngagement'
                        },
                        success: function(response) {
                            $('.ref-'+ref).html(response);
                        }
                    });
                }else{
                    $.ajax({
                        url: '{{ url('api/engagements') }}/'+ref,
                        type: 'DELETE',
                        data:{
                            reason: reason
                        },
                        success: function(response) {
                            $('.ref-'+ref).remove();
                        }
                    });
                }
            }

            $('#btn-back').click(function () {
                let dates = $('#date').val().split(' - ');
                if(dates[0] === dates[1]){
                    const day = moment(dates[0], "YYYY-MM-DD").subtract(1, 'd');

                    //console.log(day);

                    $('#date').data('daterangepicker').setStartDate(day);
                    $('#date').data('daterangepicker').setEndDate(day);

                    $.ajax({
                        url: '{{ route('api.engagements.index') }}',
                        type: 'GET',
                        data: {
                            type: 'engagementCalendar',
                            action: 'back',
                            date: dates[0]
                        },
                        success: function(response) {
                            $('#data-engagements').html(response);
                        }
                    });
                }
            });

            $('#btn-next').click(function () {
                let dates = $('#date').val().split(' - ');
                if(dates[0] === dates[1]){
                    let date = moment(dates[0], "YYYY-MM-DD").add(1, 'd');

                    $('#date').data('daterangepicker').setStartDate(date);
                    $('#date').data('daterangepicker').setEndDate(date);

                    $.ajax({
                        url: '{{ route('api.engagements.index') }}',
                        type: 'GET',
                        data:{
                            type: 'engagementCalendar',
                            action: 'next',
                            date: dates[0]
                        },
                        success: function(response) {
                            $('#data-engagements').html(response);
                        }
                    });
                }
            });

            $('#btn-today').click(function () {
                let date = new Date().toISOString().split('T')[0];

                $('#date').data('daterangepicker').setStartDate(date);
                $('#date').data('daterangepicker').setEndDate(date);

                $.ajax({
                    url: '{{ route('api.engagements.index') }}',
                    type: 'GET',
                    data:{
                        type: 'engagementCalendar',
                        action: 'today',
                    },
                    success: function(response) {
                        $('#data-engagements').html(response);
                    }
                });
            });
        });
    </script>
@endpush