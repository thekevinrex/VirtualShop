<x-splade-form {{ $attributes }}>
    
    <div class="w-full h-full absolute z-10 bg-white dark:bg-dark left-0 top-0 rounded-xl flex items-center" v-if="form.processing || form.wasSuccessful">
        <div class="flex flex-col w-full justify-center">
            <x-preloader color="pl-primary" border="pl-border-4x" size="pl-size-l"></x-preloader>
            <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                @lang ('auth.loading')
            </h2>
        </div>
    </div>

    @isset($header)
        {{ $header }}
    @endisset

    <x-splade-errors>
        <div class="flex flex-col bg-red-700 rounded-md" v-if="form.rawErrors && Object.keys(form.rawErrors).length > 0">
            <div class="w-full py-1 px-3 my-1 mx-1" v-for="(error, key) in Object.values(form.rawErrors).flat()">
                <div class="text-sm text-white">
                    @{{ error }}
                </div>
            </div>
        </div>
    </x-splade-errors>
    

    <x-splade-state>
        <div class="flex flex-col w-full bg-green-700 rounded-md" v-if="state.hasFlash('status')">
            <div class="w-full py-1 px-3 my-1 mx-1">
                <div class="text-sm text-white">
                    @{{ state.flash.status }}
                </div>
            </div>
        </div>
    </x-splade-state>


    {{ $slot }}

    @isset($footer)
        <div {{ $footer->attributes->merge(['class' => 'flex']) }}>
            {{ $footer }}
        </div>
    @endisset
    
</x-splade-form>