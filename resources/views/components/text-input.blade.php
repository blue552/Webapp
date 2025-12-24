@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-md shadow-sm text-black']) }} style="border-color: #d4c4a8; background: #ffffff; focus:border-color: #8b6f47; focus:ring-color: #8b6f47;">
