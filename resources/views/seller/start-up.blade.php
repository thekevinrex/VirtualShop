@extends('seller.layaut.docsContainer')

@section('content')

    <div class="flex flex-wrap flex-row w-full">

        <x-form class="w-full max-w-5xl flex flex-col p-20">

            <div class="w-full">

                <h1 class="text-3xl font-bold">
                    Personal Information
                </h1>

                <p class="mb-5">
                    Tu informacion personal. Tambien es utilizada para mostrarla en tu tienda
                </p>

                <InputComponent v-model:value="form.name" type="text" :inputData="{
                    'name' : 'name',
                    'isHeader' : true,
                    'placeholder' : '{{ trans('auth.name') }}',
                }" ></InputComponent>

                <InputComponent v-model:value="form.abaut_me" type="textarea" :inputData="{
                    'name' : 'abaut_me',
                    'isHeader' : true,
                    'placeholder' : '{{ 'Abaut me' }}',
                }" ></InputComponent>


                <UploadComponent v-model:value="form.avatar" :multiple="false" accept="image/*" name="avatar" id="image-avatar">
                    <template #default="{image}">
                        <div class="w-24 h-24 rounded-full border border-gray-300 overflow-hidden flex justify-center items-center relative">
                            <label for="image-avatar" class="w-full h-full z-10 absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shadow-md w-6 h-6">
                                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                  </svg>                              
                            </label>
                            <div v-html="image" class="w-full h-full"></div>
                        </div>
                    </template>
                </UploadComponent>
            </div>

            <hr class="my-10">

            <div class="w-full">

                <h1 class="text-3xl font-bold">
                    Contact Information
                </h1>

                <p class="mb-5">
                    Tu informacion de contacto a parte de tu correo en case de una urgencia. Tambien es utilizada para mostrarla en tu tienda
                </p>

                <InputComponent v-model:value="form.phone" type="text" :inputData="{
                    'name' : 'phone',
                    'isHeader' : true,
                    'placeholder' : '{{ 'Telephone' }}',
                }" ></InputComponent>

                <InputComponent v-model:value="form.telegram" type="text" :inputData="{
                    'name' : 'telegram',
                    'isHeader' : true,
                    'placeholder' : '{{ 'Telegram' }}',
                }" ></InputComponent>

            </div>
            
            <hr class="my-10">

            <div class="w-full">

                <h1 class="text-3xl font-bold">
                    Address Information
                </h1>

                <p class="mb-5">
                    Tu direccion de contacto. Usada en caso de que utilices los servicios de logistica y para calcular los precios de logistica
                </p>

                <InputComponent v-model:value="form.phone" type="text" :inputData="{
                    'name' : 'phone',
                    'isHeader' : true,
                    'placeholder' : '{{ 'Telephone' }}',
                }" ></InputComponent>

                <InputComponent v-model:value="form.telegram" type="text" :inputData="{
                    'name' : 'telegram',
                    'isHeader' : true,
                    'placeholder' : '{{ 'Telegram' }}',
                }" ></InputComponent>

            </div>

        </x-form>

        <div class="w-1/3 flex flex-none">

        </div>
    </div>

@endsection
