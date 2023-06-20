<div class="flex flex-wrap flex-row w-full">

    <div class="max-w-5xl lg:w-2/3 w-full flex flex-col p-10 relative pt-15 dark:text-white">
        <x-form 
            action="{{ route('seller.settings.payment.update') }}" 
            method="put" 
            :default="[
                'error' => [],
            ]"
            class="w-full"
        >
            <x-slot:loading>
                <x-barpage-loader></x-barpage-loader>
            </x-slot:loading>

            <section 
                aria-labelledby="payment-information-heading" 
                aria-describedby="payment-information-details" 
                class="w-full"
            >
                <h1 
                    id="payment-information-heading" 
                    class="text-3xl font-bold"
                >
                    {{__('Payment Information')}}
                </h1>

                <p 
                    class="mb-5" 
                    id="payment-information-details"
                >
                    {{ __('El sitio trabaja con QvaPay un intermediario de pago para transacciones mas limpias. Para porder redireccionar las ventas de los productos a ti tienes que prover tu link de pago del sitio QvaPay') }}
                </p>

                <InputComponent 
                    v-model:value="form.payment_option" 
                    v-model:validation="form.error" 
                    type="text" 
                    initialValue="{{ $settings->payment_option }}"
                    :inputData="{
                        'name' : 'payment_option',
                        'isHeader' : true,
                        'placeholder' : '{{ __('Qvapay link payment') }}',
                        'validate': ['Required'],
                    }" 
                >
                    <template #description>
                        <p id="address-name-details" class="-mt-4 flex flex-col mb-5 text-sm"> 
                            {{__('This is the link necesary for that the payment reach you, verify that this is correct, whorever out system will veriry eather')}}
                        </p>
                    </template>
                </InputComponent>

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