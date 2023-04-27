<div {{ $attributes->merge(['style' => '', 'class' => 'absolute px-4']) }}>
    <div class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-600 rounded-md">
        {{ $slot }}
    </div>
</div>