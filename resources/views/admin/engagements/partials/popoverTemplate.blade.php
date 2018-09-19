<strong>Responsables:</strong>
<ul>
    @foreach($detailEngagement->users as $user)
        <li>{{ $user->full_name }}</li>
    @endforeach
</ul>

@if($detailEngagement->description)
    <p>{{ $detailEngagement->description }}</p>
@endif

@if($detailEngagement->engagement->state->abbreviation === 'appoint-atten')
    @if($detailEngagement->service->abbreviation === 'aesthetic')
        <a type='button' id='noacces' class='btn label-warning btn-xs custom-margin'><i class='fa fa-check' aria-hidden='true'></i> Servicios</a>
    @endif
    @if($detailEngagement->service->abbreviation !== 'aesthetic')
        <a type='button' id='acces' class='btn label-success btn-xs custom-margin'><i class='fa fa-bookmark' aria-hidden='true'></i> Historia</a>
    @endif
@endif