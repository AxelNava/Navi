<button {{ $attributes->merge(['type' => 'submit', 'class'=>'font-inter-regular']) }}>
    {{ $slot }}
</button>
