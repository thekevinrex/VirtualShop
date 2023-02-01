<form {{ $attributes }}>

    @isset($header)
        {{ $header }}
    @endisset

    {{ $slot }}

    @isset($footer)
        {{ $footer }}
    @endisset
    
</form>