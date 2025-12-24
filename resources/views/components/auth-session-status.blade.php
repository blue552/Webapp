@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm']) }} style="color: #059669;">
        {{ $status }}
    </div>
@endif
