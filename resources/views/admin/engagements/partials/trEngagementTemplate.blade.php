@if($engagementCalendarSearch)
    @foreach($engagements_dates as $date => $engagements_date)
        <tr class="success">
            <td colspan="8">{{ convert_date_helper($date) }}</td>
        </tr>
        @foreach($engagements_date as $engagement)
            <tr class="ref-{{ $engagement->id }}">
                @include('admin.engagements.partials.tdEngagementTemplate', compact('engagement'))
            </tr>
        @endforeach
    @endforeach
@else
    @foreach($engagements as $engagement)
        <tr class="ref-{{ $engagement->id }}">
            @include('admin.engagements.partials.tdEngagementTemplate', compact('engagement'))
        </tr>
    @endforeach
@endif