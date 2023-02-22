@props(['bg' => 'bg-white focus:bg-gray-300 dark:bg-dark dark:text-white', 'border' => 'border border-gray-200 dark:border-neutral-700', 'route'])

<form action="{{ $route }}" method="post">
    @csrf
    <button type="submit" {{ $attributes->merge(['class' => "w-auto px-3 h-10 shadow-md rounded-md  flex items-center justify-center $bg $border", 'href' => '#']) }}  data-mdb-ripple="true" data-mdb-ripple-color="dark">
        <div class="font-medium text-md">
            {{ $slot }}
        </div>
    </button>
</form>