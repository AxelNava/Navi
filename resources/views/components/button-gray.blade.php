<button {{ $attributes->merge(['type' => 'submit', 'class'=>'font-inter-regular .button-gray']) }}>
    {{ $slot }}
</button>
