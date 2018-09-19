<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $engagement->pet->name.' / '.$engagement->date }}</title>
    <!-- Bootstrap style -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Custom style -->
    <link rel="stylesheet" href="{{ asset('/css/appointment-style.css') }}" media="all" />
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ asset('/images/logo.png') }}">
    </div>
    <div id="company">
        <h2 class="name">Maray</h2>
        <div>Calle 5C # 40-27, Barrio Tequendama, Cali.</div>
        <div>(+57) 2 485 4066 / (+57) 310 389 8625</div>
        <div>recepcion@maraymedvet.com</div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">Mascota: <span class="pet">{{ $engagement->pet->name }}</span></div>
            <div class="address">Raza: {{ $engagement->pet->breed->species->name }}</div>
            <div class="address">Fecha de la cita: {{ $engagement->date }}</div>
            @if($engagement->home_service)
                <div class="address">Servicio a domicilio #{{ $engagement->home_service_shift }}</div>
            @endif
        </div>
        <div id="invoice">
            <h2 class="name">{{ $engagement->client->full_name }}</h2>
            <div class="date">Cc. {{ $engagement->client->identification }}</div>
            <div class="address">{{ $engagement->client->address }}</div>
            <div class="address">{{ $engagement->client->cell_phone.' / '.$engagement->client->email }}</div>
        </div>
    </div>
    @if($engagement->home_service)
        <table border="0" cellspacing="0" cellpadding="0" class="table table-striped">
            <thead>
            <tr>
                <th>Servicio</th>
                <th>Hora / turno</th>
                <th>Responsables</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($engagement->detailEngagements as $detailEngagement)
                <tr>
                    <td>{{ $detailEngagement->service->name }}</td>
                    <td>
                        @if($detailEngagement->service->abbreviation === 'aesthetic')
                            Turno #{{ $detailEngagement->assigned_shift }}
                        @endif
                    </td>
                    <td>
                        @foreach($detailEngagement->users as $user)
                            @if($loop->last)
                                {{ $user->full_name }}
                            @else
                                {{ $user->full_name.', ' }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $detailEngagement->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <table border="0" cellspacing="0" cellpadding="0" class="table table-striped">
            <thead>
            <tr>
                <th>Servicio</th>
                <th>Hora / turno</th>
                <th>Responsables</th>
                <th style="width: 45%;">Descripción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($engagement->detailEngagements as $detailEngagement)
                <tr>
                    <td>{{ $detailEngagement->service->name }}</td>
                    <td>
                        @if($detailEngagement->service->abbreviation === 'aesthetic')
                            Turno #{{ $detailEngagement->assigned_shift }}
                        @else
                            {{ $detailEngagement->start_time.' - '.$detailEngagement->end_time }}
                        @endif
                    </td>
                    <td>
                        @foreach($detailEngagement->users as $user)
                            @if($loop->last)
                                {{ $user->full_name }}
                            @else
                                {{ $user->full_name.', ' }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $detailEngagement->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <div id="notices" class="clearfix">
        <div class="notice">Firma propietario</div>
        <div class="invoice">Recibo de servicio No. {{ $engagement->id }}</div>
    </div>
</main>
<!-- jQuery 3 -->
<script src="{{ asset('/plugins/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>