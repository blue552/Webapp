<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-brown inline-flex items-center justify-center px-6 py-2.5 border border-transparent rounded-md font-semibold text-sm whitespace-nowrap']) }}>
    {{ $slot }}
</button>
