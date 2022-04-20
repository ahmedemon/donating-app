@php
$notifications = \App\Models\PurchasedProduct::where('owner_id', Auth::user()->id)
    ->latest()
    ->take(20)
    ->get();
@endphp
@foreach ($notifications as $item)
    <a href="{{ route('buyer-request.view.request', $item->id) }}" class="">
        <li class="{{ $item->seen == 0 ? 'bg' : '' }}">
            <div class="timeline-panel mb-2 border">
                <div class="media me-2 rounded-0">
                    <img alt="image" width="50" src="{{ asset('storage/donation/' . $item->donation->images) }}">
                </div>
                <div class="media-body">
                    <h6 class="mb-1" style="color: #14c8ff !important;">{{ $item->user->name }} <small style="color: white !important;">requested for <b>({{ $item->donation->title }})</b>.</small></h6>
                    <small class="d-block">{{ date('M d, Y, h:i a', strtotime($item->created_at)) }}</small>
                </div>
            </div>
        </li>
    </a>
@endforeach
