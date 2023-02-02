<x-splade-form {{ $attributes }}>

    @isset($header)
        {{ $header }}
    @endisset

    {{ $slot }}

    @isset($footer)
        {{ $footer }}
    @endisset
    
</x-splade-form>