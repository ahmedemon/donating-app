@php
$actionRoute = 'maintenance.' . $action;
@endphp
<div class="col-md-6 mb-2">
    <form action="{{ route($actionRoute) }}" method="POST" id="{{ $action }}">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary form-control">{{ $name }}</button>
    </form>
</div>
