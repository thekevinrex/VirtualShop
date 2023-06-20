<div class="flex flex-wrap flex-row w-full">

    <div class="max-w-5xl lg:w-2/3 w-full flex flex-col p-10 relative pt-15 dark:text-white">
        <x-form 
            action="{{ route('seller.settings.address.update') }}" 
            method="put" 
            :default="[
                'error' => [],
                'municipio' => $settings->address->municipality_id,
                'provincia' => $settings->address->province_id,
            ]"
            class="w-full"
        >
            <x-slot:loading>
                <x-barpage-loader></x-barpage-loader>
            </x-slot:loading>


            <section aria-describedby="address-information-details" aria-labelledby="address-information-heading" class="w-full">

                <h1 id="address-information-heading" class="text-3xl font-bold">
                    {{__('Address Information')}}
                </h1>

                <p class="mb-5" id="address-information-details">
                    {{  __('Your address direction. Used in case that you use the logistic services and to calculate the cost of the logistic')}}
                </p>

                <InputComponent 
                    v-model:value="form.address_name" 
                    v-model:validation="form.error" 
                    type="text" 
                    initialValue="{{ $settings->address->name }}"
                    :inputData="{
                        'name' : 'address_name',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Address name') }}',
                        'validate' : ['Required'],
                        'ariaDescribedby' : 'address-name-details',
                    }" 
                >
                    <template #description>
                        <p id="address-name-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('This is the name that it will addres you when picking the products')}}
                        </p>
                    </template>
                </InputComponent>

                <SelectComponent 
                    v-model:value="form.provincia" 
                    :initialData="{{ $provincies }}" 
                    :inputData="{
                        'name' : 'provincia',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Province') }}',
                        'defaultMessage' : '{{__('Chose your province')}}',
                    }"
                ></SelectComponent>

                <SelectComponent 
                    v-model:value="form.municipio" 
                    :fetchDataWithValue="form.provincia" 
                    :initialData="{{ $municipalities }}" 
                    fetchDataFrom="{{ route('municipios.get') }}" 
                    data="fetch" 
                    :inputData="{
                        'name' : 'municipio',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Municipality') }}',
                        'defaultMessage' : '{{ __('Chose your municipality')}}',
                    }"
                >
                    <template #loader><x-preloader color="pl-grey" border="pl-border-2x" size="pl-size-xs"></x-preloader></template>
                </SelectComponent>

                <InputComponent 
                    v-model:value="form.address_location" 
                    v-model:validation="form.error" 
                    type="text" 
                    initialValue="{{ $settings->address->location }}"
                    :inputData="{
                        'name' : 'address_location',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Exact address') }}',
                        'validate' : ['Required'],
                    }" 
                >
                    <template #description>
                        <p id="address-location-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('Provide your exact address')}}
                        </p>
                    </template>
                </InputComponent>

                <InputComponent 
                    v-model:value="form.address_preferencia" 
                    type="textarea" 
                    initialValue="{{ $settings->address->preferences }}"
                    :inputData="{
                        'name' : 'address_preferencia',
                        'isHeader' : true,
                        'placeholder' : '{{ 'Address preferences' }}',
                    }" 
                ></InputComponent>
            </section>

            <hr class="my-10">

            <div class="w-full flex justify-end">
                <button 
                    type="submit" 
                    :disabled="form.error.filter(e => {return e.error}).length > 0" 
                    class="
                        rounded-md 
                        border border-transparent 
                        disabled:bg-indigo-300 bg-indigo-600 
                        py-2 px-4 text-sm text-white 
                        hover:bg-indigo-700 
                        focus:outline-none focus:ring-2 font-bold focus:ring-indigo-500 focus:ring-offset-2" 
                    data-mdb-ripple="true" 
                    data-mdb-ripple-color="ligth"
                >
                    {{ __('Update seller profile') }}
                </button>
            </div>

        </x-form>
    </div>

    <div class="lg:w-1/3 w-full flex-col flex flex-none">
        
        
    </div>
</div>