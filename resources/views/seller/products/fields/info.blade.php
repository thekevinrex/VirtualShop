<div class="flex flex-col w-2/3 p-6">
    
    <section aria-labelledby="product-name-heading" aria-describedby="product-name-details">

        <h1 id="product-name-heading" class="text-lg font-semibold">
            @lang('product.product_name')
        </h1>

        <p id="product-name-details" class="mb-2">
            @lang('product.product_name_help')
        </p>
        
        <InputComponent v-model:value="info.name" @field-data.once="fieldsData" type="text" :inputData="{
            'name' : 'name',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.product_name') }}',
            'validate' : ['Required'],
            'ariaLabelledby' : 'product-name-heading',
        }" >
        </InputComponent>
        
    </section>

    <hr class="my-5">

    <section aria-labelledby="product-des-heading" aria-describedby="product-des-details">

        <h1 id="product-des-heading" class="text-lg font-semibold">
            @lang('product.product_des')
        </h1>

        <p class="mb-2" id="product-des-details">
            @lang('product.product_des_help')
        </p>

        <InputComponent v-model:value="info.description" type="textarea" :inputData="{
            'name' : 'description',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.product_des') }}',
            'ariaLabelledby' : 'product-des-heading',
        }" ></InputComponent>
    </section>
    
    <hr class="my-5">

    <section aria-labelledby="product-info-heading" aria-describedby="product-info-details">

        <div class="flex flex-row justify-between">
            <h1 id="product-info-heading" class="text-lg font-semibold">
                @lang('product.product_infos')
            </h1>

            <div class="flex py-1 px-3 bg-transparent text-primary rounded-md" @click="addInfo" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                @lang('product.add_info')
            </div>
        </div>

        <p class="mb-2" id="product-info-details">
            @lang('product.product_infos_help')
        </p>

        <div class="flex flex-col w-full">
            <div class="flex flex-row space-x-3" v-for="i in info.details" :key="i.id">

                <div class="w-40 flex-none">
                    <InputComponent v-model:value="i.key" @field-data="fieldsData" type="text" :inputData="{
                        'name' : 'info_key',
                        'isHeader' : false,
                        'placeholder' : '{{ trans('product.info_key') }}',
                        'validate' : ['Required'],
                    }" ></InputComponent>
                </div>
                
                <InputComponent v-model:value="i.value" @field-data="fieldsData" type="text" :inputData="{
                    'name' : 'info_value',
                    'isHeader' : false,
                    'placeholder' : '{{ trans('product.info_value') }}',
                    'validate' : ['Required'],
                }" ></InputComponent>

                <div class="flex flex-none w-10 h-10 border rounded-md dark:border-neutral-700 border-gray-300 shadow-md items-center justify-center" @click="deleteInfo(i.id)" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                      </svg>                
                </div>
            </div>
        </div>

    </section>

    <hr class="my-5">

    <section aria-labelledby="product-restrict-heading" aria-describedby="product-restrict-details">

        <h1 id="product-restrict-heading" class="text-lg font-semibold">
            @lang('product.restrict_age')
        </h1>

        <p class="mb-2" id="product-restrict-details">
            @lang('product.restrict_age_help')
        </p>

        <div class="flex items-center">
            <input id="restrict_age" name="restrict_age" v-model="info.restric_age" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <label for="restrict_age" class="ml-2 block text-sm text-gray-900 dark:text-white">
                @lang('product.restrict_age_q')
            </label>
        </div>

    </section>
    
    <hr class="my-5">

    <section aria-labelledby="product-fetch-heading" aria-describedby="product-fetch-details">

        <h1 id="product-fetch-heading" class="text-lg font-semibold">
            @lang('product.product_videos')
        </h1>

        <p class="mb-2" id="product-fetch-details">
            @lang('product.product_videos_help')
        </p>

        <div class="flex flex-row">
            <InputComponent v-model:value="fetch_video" type="text" :inputData="{
                'name' : 'fetch_video',
                'isHeader' : false,
                'placeholder' : '{{ trans('product.fetch_videos') }}',
            }" ></InputComponent>

            <div class="w-10 h-10 flex items-center justify-center flex-none rounded-md border dark:border-neutral-700 border-gray-300 ml-1 shadow-md" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M9.75 6.75h-3a3 3 0 00-3 3v7.5a3 3 0 003 3h7.5a3 3 0 003-3v-7.5a3 3 0 00-3-3h-3V1.5a.75.75 0 00-1.5 0v5.25zm0 0h1.5v5.69l1.72-1.72a.75.75 0 111.06 1.06l-3 3a.75.75 0 01-1.06 0l-3-3a.75.75 0 111.06-1.06l1.72 1.72V6.75z" clip-rule="evenodd" />
                    <path d="M7.151 21.75a2.999 2.999 0 002.599 1.5h7.5a3 3 0 003-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 01-4.5 4.5H7.151z" />
                  </svg>                  
            </div>
        </div>
    </section>

    <hr class="my-5">

    <section class="mb-5" aria-labelledby="product-ratings-heading" aria-describedby="product-ratings-details">

        <h1 id="product-ratings-heading" class="text-lg font-semibold">
            @lang('product.ratings')
        </h1>

        <p class="mb-2" id="product-ratings-details">
            @lang('product.ratings_help')
        </p>

        <SelectComponent v-model:value="info.ratings" :initialData="{{ json_encode($ratings) }}" :inputData="{
            'name' : 'ratings',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.ratings') }}',
        }"></SelectComponent>

    </section>

</div>

<div class="flex flex-col w-1/3 p-6">

    @include('seller.products.fields.information')

    <section class="mb-5" aria-labelledby="product-cate-heading" aria-describedby="product-cate-details">
        <h1 id="product-cate-heading" class="text-lg font-semibold">
            @lang('product.product_category')
        </h1>

        <p id="product-cate-details">
            @lang('product.product_category_help')
        </p>

        <SelectComponent v-model:value="listening.category" @field-data="fieldsData" :setLoading="loading" :initialData="{{ $categories }}" :inputData="{
            'name' : 'category',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.product_category') }}',
            'defaultMessage' : '{{ trans('product.chose_category') }}',
            'required' : true,
        }">
            <template #loader><x-preloader color="pl-grey" border="pl-border-2x" size="pl-size-xs"></x-preloader></template>
        </SelectComponent>
    </section>
    
    <div v-if="required.includes('restricted')" class="bg-indigo-500 rounded-lg p-6 mb-5 text-white">
        Esta categoria de producto está restringida. Despues de publicar el producto estara inactivo hasta que se verifique que no tiene ningun problema
    </div>

    <section v-if="required.includes('marca')" class="mb-5" aria-labelledby="product-marca-heading" aria-describedby="product-marca-details">
        <h1 id="product-marca-heading" class="text-lg font-semibold">
            @lang('product.product_brand')
        </h1>

        <p id="product-marca-details">
            @lang('product.product_brand_help')
        </p>

        <SelectComponent v-model:value="listening.marca" :initialData="{{ $marcas }}" :inputData="{
            'name' : 'marca',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.product_brand') }}',
            'defaultMessage' : '{{ trans('product.chose_brand') }}',
        }"></SelectComponent>
    </section>
    
    <div v-if="required.includes('modelo')" class="mb-5" aria-labelledby="product-modelo-heading" aria-describedby="product-modelo-details">
        <h1 class="text-lg font-semibold" id="product-modelo-heading">
            @lang('product.product_modelo')
        </h1>

        <p id="product-modelo-details">
            @lang('product.product_modelo_help')
        </p>

        <SelectComponent v-model:value="listening.modelo" :fetchDataWithValue="listening.marca" fetchDataFrom="{{ route('seller.modelos.get') }}" initialData="fetch" :inputData="{
            'name' : 'modelo',
            'isHeader' : true,
            'placeholder' : '{{ trans('product.product_modelo') }}',
            'defaultMessage' : '{{ trans('product.chose_modelo') }}',
        }">
            <template #loader><x-preloader color="pl-grey" border="pl-border-2x" size="pl-size-xs"></x-preloader></template>
        </SelectComponent>
    </div>

</div>