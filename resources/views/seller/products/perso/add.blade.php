<x-splade-modal slideover class=" dark:bg-dark dark:text-white" max-width="lg">

    <section aria-labelledby="select-perso-module-heading" aria-describedby="select-perso-module-details">

        <h1 class="text-lg font-semibold" id="select-perso-module-heading">
            {{__('Product personalization modules')}}
        </h1>

        <p class="text-base mb-5" id="select-perso-module-details">
            {{__('Select the module that you want to add, each module has his own elements')}}
        </p>

        <selectModuleComponent v-slot="{ addModule }">
            @foreach ($modules as $item)
                <div @click="addModule('{{ $item }}', modal.close)">
                    <x-dynamic-component :component="'modules.' . $item"/>
                </div>
            @endforeach
        </selectModuleComponent>

    </section>
    
</x-splade-modal>