<td>
    @if($engagement->home_service != true)
        @php($flag = true)
        @foreach($engagement->detailEngagements as $detailEngagement)
            @if($detailEngagement->service->abbreviation === 'consultation')
                @php($flag = false)
            @endif
        @endforeach
        @foreach($engagement->detailEngagements as $detailEngagement)
            @if($detailEngagement->service->abbreviation === 'consultation')
                <div>{{ $detailEngagement->start_time.' - '.$detailEngagement->end_time }}</div>
            @elseif($detailEngagement->service->abbreviation === 'services' && $flag)
                <div>{{ $detailEngagement->start_time.' - '.$detailEngagement->end_time }}</div>
            @endif
        @endforeach
    @endif
</td>
<td>{{ $engagement->client->full_name }}</td>
<td>{{ $engagement->pet->name }}</td>
<td>
    @foreach($engagement->detailEngagements as $detailEngagement)
        <a type="button" class="label label-primary custom-margin" data-toggle="popover" data-content="@include('admin.engagements.partials.popoverTemplate', compact('detailEngagement'))">{{ $detailEngagement->service->name }}</a>
    @endforeach
</td>
<td align="center">
    @foreach($engagement->detailEngagements as $detailEngagement)
        @if($detailEngagement->service->abbreviation === 'aesthetic')
            {{ $detailEngagement->assigned_shift }}
        @endif
    @endforeach
</td>
<td align="center">
    {{ $engagement->home_service_shift }}
</td>
<td>
    @if($engagement->state->abbreviation === 'appoint-atten')
        <a type="button" class="btn label-success btn-xs" style="padding: 1px 7px;"><i class="fa fa-usd" aria-hidden="true"></i></a>
    @endif
    @if($engagement->state->abbreviation === 'appoint-atten' || $engagement->state->abbreviation === 'appoint-noatten')
        <a type="button" class="btn label-warning btn-xs btn-undo-assist" ref={{ $engagement->id }}><i class="fa fa-undo" aria-hidden="true"></i></a>
    @endif
    @if($engagement->state->abbreviation === 'gen-act')
        <a type="button" class="btn label-success btn-xs btn-assist" ref={{ $engagement->id }}><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
        <a type="button" class="btn label-warning btn-xs btn-not-assist" ref={{ $engagement->id }}><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
        <a type="button" class="btn label-danger btn-xs btn-cancel" ref={{ $engagement->id }}><i class="fa fa-times" aria-hidden="true"></i></a>
        <a type="button" href="{{ route("engagements.edit", $engagement->id) }}" class="btn label-info btn-xs custom-margin btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    @endif
    <a type="button" class="btn bg-navy btn-xs btn-print" target="_blank" href="{{ route("engagements.print", $engagement->id) }}"><i class="fa fa-print" aria-hidden="true"></i></a>
</td>
