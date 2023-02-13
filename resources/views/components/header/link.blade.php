@props(['id', 'type' => 'botton', 'bg' => 'bg-white focus:bg-gray-300', 'border' => 'border border-gray-200 dark:border-neutral-700'])

@if($type && $type == 'dropdown')
<div class="dropdown relative">
    <div {{ $attributes->merge(['class' => "w-auto px-3 h-10 shadow-md rounded-md dropdown-toggle flex items-center justify-center $bg $border", 'href' => '#']) }} id="{{ $id }}" data-bs-toggle="dropdown" aria-expanded="false" data-mdb-ripple="true" data-mdb-ripple-color="dark">
        <div class="font-medium text-md">
            {{ $slot }}
        </div>
    </div>

    <ul class=" dropdown-menu min-w-max absolute hidden bg-white text-base z-50 float-left py-3 list-none text-left rounded-lg shadow-lg mt-1 m-0 bg-clip-padding border-none left-auto right-0" aria-labelledby="{{ $id }}" >
        {{ $dropdown }}
    </ul>
</div>
@else
<Link {{ $attributes->merge(['class' => "w-auto px-3 h-10 shadow-md rounded-md  flex items-center justify-center $bg $border", 'href' => '#']) }}  data-mdb-ripple="true" data-mdb-ripple-color="dark">
    <div class="font-medium text-base">
        {{ $slot }}
    </div>
</Link>        
@endif