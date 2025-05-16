@props(['listing'])

@php
    if(date('d') - (\Carbon\Carbon::parse($listing->created_at)->day) < 0){ $listingPosted='Posted: ' .
        \Carbon\Carbon::parse($listing->created_at)->format('d.m.Y');
    }elseif (date('d') - (\Carbon\Carbon::parse($listing->created_at)->day) == 0) {
        $listingPosted = 'Posted: Today';
    }else{
        $listingPosted = 'Posted: ' . date('d') - (\Carbon\Carbon::parse($listing->created_at)->day) . ' ago';
    }
@endphp

<p class="font-semibold">
    {{ $listingPosted }}
</p>