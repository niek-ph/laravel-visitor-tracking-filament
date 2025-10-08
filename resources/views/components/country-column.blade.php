@php
    use NiekPH\LaravelVisitorTrackingFilament\Facades\VisitorTrackingFilament;

    $code = $getState() ?? '';
    $flag = VisitorTrackingFilament::getCountryFlagEmoji($code);
    $name = VisitorTrackingFilament::getCountryName($code);
@endphp


<span class="inline-flex items-center gap-2">
    <span class="text-xl leading-none">{{ $flag }}</span>
    <span>{{ $name }}</span>
</span>
