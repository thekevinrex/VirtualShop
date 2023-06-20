<div class="flex flex-wrap flex-row w-full">

    <div class="max-w-5xl lg:w-2/3 w-full flex flex-col p-10 relative pt-15 dark:text-white">
        <x-form 
            action="{{ route('seller.settings.info.update') }}" 
            method="put" 
            :default="[
                'error' => [],
                'avatar' => [
                    'image' => $settings->avatar->url,
                    'path' => Storage::url($settings->avatar->url),
                ],
            ]"
            class="w-full"
        >
            <x-slot:loading>
                <x-barpage-loader></x-barpage-loader>
            </x-slot:loading>

            <section 
                aria-labelledby="personal-information-heading" 
                aria-describedby="personal-information-details" 
                class="w-full mt-5"
            >
                <h1 
                    id="personal-information-heading" 
                    class="text-3xl font-bold"
                >
                    {{__('Personal Information')}}
                </h1>

                <p 
                    class="mb-5" 
                    id="personal-information-details"
                >
                    {{__('Your personal information. Also is used to show in your shop')}}
                </p>

                <InputComponent 
                    v-model:value="form.name" 
                    v-model:validation="form.error" 
                    type="text" 
                    initialValue="{{ $settings->name }}"
                    :inputData="{
                        'name' : 'name',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Seller name') }}',
                        'ariaDescribedby' : 'personal-name-details',
                        'validate' : ['Required'],
                    }"
                >
                    <template #description>
                        <p id="personal-name-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('This is your public seller name')}}
                        </p>
                    </template>
                </InputComponent>
                

                <InputComponent 
                    v-model:value="form.abaut_me" 
                    type="textarea" 
                    initialValue="{{ $settings->abaut_me }}"
                    :inputData="{
                        'name' : 'abaut_me',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Abaut me') }}',
                        'ariaDescribedby' : 'personal-abaut-details'
                    }" 
                >
                    <template #description>
                        <p id="personal-abaut-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('Write a text abaut you for yours seller know you')}}
                        </p>
                    </template>
                </InputComponent>


                <UploadComponent 
                    v-model:value="form.avatar" 
                    :multiple="false" 
                    accept="image/*" 
                    name="avatar" 
                    id="image-avatar"
                >
                    <template 
                        #default="{image}"
                    >
                        <div 
                            class="
                                w-24 h-24 
                                rounded-full 
                                border border-gray-300 
                                overflow-hidden 
                                flex justify-center items-center 
                                relative"
                        >
                            <label 
                                for="image-avatar" 
                                class="w-full h-full z-10 absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shadow-md w-6 h-6">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                </svg>                              
                            </label>
                            <div 
                                v-html="image" 
                                class="w-full h-full">
                            </div>
                        </div>

                        <p 
                            id="personal-avatar-details" 
                            class="mt-2 text-sm"
                        > 
                            {{  __('Upload a profile photo for your shop. This is gone to be a public photo') }}
                        </p>

                    </template>
                </UploadComponent>

            </section>

            <hr class="my-10">

            <section 
                aria-labelledby="contact-information-heading" 
                aria-describedby="contact-information-details" 
                class="w-full"
            >
                <h1 
                    id="contact-information-heading" 
                    class="text-3xl font-bold"
                >
                    {{__('Contact Information')}}
                </h1>

                <p 
                    id="contact-information-details" 
                    class="mb-5"
                >
                    {{__('Your contact information beside your email address in case of an emergency.Is also used to show in your shop')}}
                </p>

                <InputComponent 
                    v-model:value="form.telephone" 
                    v-model:validation="form.error" 
                    type="text" 
                    initialValue="{{ $settings->telephone }}"
                    :inputData="{
                        'name' : 'telephone',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Telephone') }}',
                        'validate' : ['Required'],
                    }"  
                ></InputComponent>

                <InputComponent 
                    v-model:value="form.telegram" 
                    type="text" 
                    initialValue="{{ $settings->telegram }}"
                    :inputData="{
                        'name' : 'telegram',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Telegram') }}',
                    }" 
                ></InputComponent>

            </section>
            
            <hr class="my-10">
{{-- 
            <section aria-describedby="address-information-details" aria-labelledby="address-information-heading" class="w-full">

                <h1 id="address-information-heading" class="text-3xl font-bold">
                    {{__('Address Information')}}
                </h1>

                <p class="mb-5" id="address-information-details">
                    {{  __('Your address direction. Used in case that you use the logistic services and to calculate the cost of the logistic')}}
                </p>

                <InputComponent v-model:value="form.address_name" v-model:validation="form.error" type="text" :inputData="{
                    'name' : 'address_name',
                    'isHeader' : true,
                    'placeholder' : '{{ __('Address name') }}',
                    'validate' : ['Required'],
                    'ariaDescribedby' : 'address-name-details',
                }" >
                    <template #description>
                        <p id="address-name-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('This is the name that it will addres you when picking the products')}}
                        </p>
                    </template>
                </InputComponent>

                <SelectComponent v-model:value="form.provincia" :initialData="{{ $provincias }}" :inputData="{
                    'name' : 'provincia',
                    'isHeader' : true,
                    'placeholder' : '{{ __('Province') }}',
                    'defaultMessage' : '{{__('Chose your province')}}',
                }"></SelectComponent>

                <SelectComponent v-model:value="form.municipio" :fetchDataWithValue="form.provincia" fetchDataFrom="{{ route('municipios.get') }}" data="fetch" :inputData="{
                    'name' : 'municipio',
                    'isHeader' : true,
                    'placeholder' : '{{ __('Municipality') }}',
                    'defaultMessage' : '{{ __('Chose your municipality')}}',
                }">
                    <template #loader><x-preloader color="pl-grey" border="pl-border-2x" size="pl-size-xs"></x-preloader></template>
                </SelectComponent>

                <InputComponent v-model:value="form.address_location" v-model:validation="form.error" type="text" :inputData="{
                    'name' : 'address_location',
                    'isHeader' : true,
                    'placeholder' : '{{ __('Exact address') }}',
                    'validate' : ['Required'],
                }" >
                    <template #description>
                        <p id="address-location-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('Provide your exact address')}}
                        </p>
                    </template>
                </InputComponent>

                <InputComponent v-model:value="form.address_preferencia" type="textarea" :inputData="{
                    'name' : 'address_preferencia',
                    'isHeader' : true,
                    'placeholder' : '{{ 'Address preferences' }}',
                }" ></InputComponent>
            </section>

            <hr class="my-10"> --}}
{{-- 
            <section aria-labelledby="payment-information-heading" aria-describedby="payment-information-details" class="w-full">

                <h1 id="payment-information-heading" class="text-3xl font-bold">
                    {{__('Payment Information')}}
                </h1>

                <p class="mb-5" id="payment-information-details">
                    {{ __('El sitio trabaja con QvaPay un intermediario de pago para transacciones mas limpias. Para porder redireccionar las ventas de los productos a ti tienes que prover tu link de pago del sitio QvaPay') }}
                </p>

                <InputComponent v-model:value="form.payment_option" v-model:validation="form.error" type="text" :inputData="{
                    'name' : 'payment_option',
                    'isHeader' : true,
                    'placeholder' : '{{ __('Qvapay link payment') }}',
                    'validate': ['Required'],
                }" >
                    <template #description>
                        <p id="address-name-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('This is the link necesary for that the payment reach you, verify that this is correct, whorever out system will veriry eather')}}
                        </p>
                    </template>
                </InputComponent>


            </section> --}}
{{-- 
            <hr class="my-10"> --}}

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