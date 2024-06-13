<button {{ $attributes->merge(['type' => 'submit', 'class'=>'font-inter-regular button-blue-sky']) }}>
    {{ $slot }}
</button>
