@extends('seller.layauts.container')

@section('tab-header')
<div class="
    sticky-top 
    top-14 
    bg-white 
    border-b 
    border-gray-300 
    dark:bg-dark 
    dark:border-neutral-700 
    dark:text-white 
    flex w-full h-24 flex-col">

    <h1 class="font-bold text-2xl h-12 py-2 px-5 flex flex-row w-full items-center">

        <div class="w-10 h-10 rounded-full overflow-hidden flex justify-center items-center shrink-0">
            <Link href="{{ route('seller.products') }}" class="w-full h-full flex justify-center items-center" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M2.515 10.674a1.875 1.875 0 000 2.652L8.89 19.7c.352.351.829.549 1.326.549H19.5a3 3 0 003-3V6.75a3 3 0 00-3-3h-9.284c-.497 0-.974.198-1.326.55l-6.375 6.374zM12.53 9.22a.75.75 0 10-1.06 1.06L13.19 12l-1.72 1.72a.75.75 0 101.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L15.31 12l1.72-1.72a.75.75 0 10-1.06-1.06l-1.72 1.72-1.72-1.72z" clip-rule="evenodd" />
                </svg>              
            </Link>
        </div>
        <span>
            {{__('Personalization')}}
        </span>
    </h1>
    <div class="flex flex-row flex-nowrap justify-between w-full h-12 items-center px-5">
        
        <div class="flex flex-row h-12 space-x-2 dark:text-white items-end">

        </div>
        
        <div class="flex flex-none justify-end px-5">

            <Link 
                href="{{ route('seller.products.edit', $product) }}" 
                class="py-1 px-3 rounded-md bg-transparent text-primary"  
                data-mdb-ripple="true" 
                data-mdb-ripple-color="dark"
            >
                {{__('Edit product')}}
            </Link>

        </div>
    </div>
</div>
@endsection

@section('content')

<div class="flex w-full flex-wrap bg-white dark:bg-dark dark:text-white">
    <div class="flex flex-col items-start p-5 w-full">

        <section class="w-full" aria-labelledby="perso-modules-heading" aria-describedby="perso-modules-details">

            <h1 id="perso-modules-heading" class="flex flex-row justify-between">
                <span class="font-bold text-2xl ">
                    {{__('Personalization modules')}}
                </span>

                <Link slideover href="{{ route('seller.products.perso.create', $product) }}" class="py-1 px-3 rounded-md bg-transparent text-primary"  data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    {{__('Add new module')}}
                </Link>
            </h1>

            <p id="perso-modules-details" class="text-base mb-5 max-w-3xl">
                {{__('Personalize the product page, trow text, images, videos and any other element to help impulse and increase the trafic and sels. It help the sellers to show the history or any other caracteristic of the product')}}
            </p>

        </section>

        <div class="space-y-5 mt-5 flex flex-col w-full">

            <productModulesComponent 
                v-slot="{ 
                    modules, 
                    isEditModule, 
                    editModule, 
                    deleteModule, 
                    orderModule, 
                    handleSubmit 
                }" 
                :modulesData="{{ json_encode($modulesData) }}" 
                :modulesInfo="{{ json_encode($modulesInfo) }}"
            >
                <x-splade-errors>
                    <div 
                        class="flex flex-col bg-red-700 rounded-md" 
                        v-if="Object.keys(errors.all).length > 0"
                    >
                        <div 
                            class="w-full py-1 px-3 my-1 mx-1" 
                            v-for="(error, key) in Object.values(errors.all).flat()"
                        >
                            <div class="text-sm text-white">
                                @{{ error }}
                            </div>
                        </div>
                    </div>
                </x-splade-errors>

                <x-splade-form 
                    action="{{ route('seller.products.perso.store', $product) }}" 
                    method="post"
                >
                    <button 
                        type="button" 
                        @click.prevent="handleSubmit(form)" 
                        class="rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 font-bold focus:ring-indigo-500 focus:ring-offset-2"
                        data-mdb-ripple="true" 
                        data-mdb-ripple-color="ligth"
                    >
                        {{__('Save changes')}}
                    </button>
                </x-splade-form>
                
                <div 
                    class="flex flex-col w-full border-b border-gray-300 dark:border-neutral-700" 
                    v-for="module in modules" 
                    :key="module.key"
                >
                    <div class="w-full flex flex-row justify-between">

                        <div class="flex flex-row shrink-0 items-center space-x-2">
                            
                            <div 
                                v-if="module.order > 1"  
                                @click="orderModule('up', module.key)" 
                                data-mdb-ripple="true" 
                                data-mdb-ripple-color="dark" 
                                class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06l-6.22-6.22V21a.75.75 0 01-1.5 0V4.81l-6.22 6.22a.75.75 0 11-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
                                </svg>                                                          
                            </div>
                            
                            <div 
                                v-if="module.order < modules.length" 
                                @click="orderModule('down', module.key)" 
                                data-mdb-ripple="true" 
                                data-mdb-ripple-color="dark" 
                                class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v16.19l6.22-6.22a.75.75 0 111.06 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 111.06-1.06l6.22 6.22V3a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                </svg>                              
                            </div>

                            <h2>
                                {{__('Module')}}
                            </h2>

                        </div>

                        <div class="w-full flex flex-row justify-end">
                            
                            <div 
                                v-if="module.key != isEditModule" 
                                data-mdb-ripple="true" 
                                data-mdb-ripple-color="dark" 
                                @click="editModule(module.key)" 
                                class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>                                                              
                            </div>

                            <div 
                                data-mdb-ripple="true" 
                                data-mdb-ripple-color="dark" 
                                @click="deleteModule(module.key)" 
                                class="w-10 h-10 rounded-full overflow-hidden flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                  </svg>                                                                                            
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex flex-row flex-wrap py-4">

                        <div class="w-1/2 max-w-[450px]">
                            <ModuleContent 
                                :module="module.type">
                            </ModuleContent>
                        </div>

                        <div class="flex w-1/2 flex-col px-4 space-y-3" v-if="module.key != isEditModule">
                            
                            <section 
                                v-if="module.title != null"
                            >
                                <h2 class="text-lg font-semibold">
                                    {{__('Title')}}
                                </h2>
                                <p 
                                    class="text-base" 
                                    v-text="module.title">
                                </p>
                            </section>

                            <section 
                                v-if="module.description != null"
                            >
                                <h2 class="text-lg font-semibold">
                                    {{__('Description')}}
                                </h2>
                                <p 
                                    class="text-sm text-ellipsis" 
                                    v-text="module.description">
                                </p>
                            </section>

                            <section 
                                v-if="module.image != null"
                            >
                                <div class="w-24 h-24 rounded-md border overflow-hidden flex justify-center items-center relative">
                                    <img 
                                        :src="module.image.path" 
                                        class="w-full h-full" 
                                    />
                                </div>
                            </section>
                        </div>

                        <div 
                            class="flex w-1/2 flex-col px-4 space-y-5" 
                            v-if="module.key == isEditModule"
                        >
                            <section 
                                v-if="module.title != null"
                            >
                                <InputComponent v-model:value="module.title" type="text" :inputData="{
                                    'name' : 'title',
                                    'isHeader' : true,
                                    'placeholder' : '{{ trans('Title') }}',
                                }" >
                                </InputComponent>
                            </section>
                            
                            <section 
                                v-if="module.description != null"
                            >
                                <InputComponent v-model:value="module.description" type="textarea" :inputData="{
                                    'name' : 'description',
                                    'isHeader' : true,
                                    'placeholder' : '{{ trans('Description') }}',
                                }" >
                                </InputComponent>
                            </section>

                            <section 
                                v-if="module.image != null"
                            >
                                <UploadComponent 
                                    v-model:value="module.image" 
                                    :multiple="false" 
                                    accept="image/*" 
                                    name="module-image" 
                                    id="module-image"
                                >
                                    <template 
                                        #default="{image, data}"
                                    >
                                        <div 
                                            class="w-24 h-24 rounded-md border overflow-hidden flex justify-center items-center relative" 
                                            :class="(data.error)? 'border-red-600' : 'border-gray-300'"
                                        >
                                            <label 
                                                for="module-image" 
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
                                    </template>
                                </UploadComponent>
                            </section>

                        </div>
                    </div>

                </div>
            </productModulesComponent>
        </div>

    </div>
</div>

@endsection