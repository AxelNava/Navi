<button {{ $attributes->merge(['type' => 'submit', 'class'=>'font-inter-regular button-green']) }}>
    {{ $slot }}
</button>
