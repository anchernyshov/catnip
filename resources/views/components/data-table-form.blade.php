<div 
    x-data="{
        show: @entangle($attributes->wire('model')),
    }"
    x-cloak
    x-show="show"
>
    {{ $slot }}
</div>