<div class="flex flex-col w-2/5 p-6">

    @include('seller.products.fields.information')

    <section aria-labelledby="variantes-cate-heading" aria-describedby="variantes-cate-details">

        <div class="flex flex-row justify-between">
            <h1 id="variantes-cate-heading" class="text-lg font-semibold">
                {{__('Product variants categories')}}
            </h1>
        </div>

        <p class="mb-2" id="variantes-cate-details">
            {{__('Add diferents categories like colors, sizes, etc')}}
        </p>

        <div class="flex flex-col w-full">
            <div class="flex flex-row space-x-3" v-for="i in variantsData.cates" :key="i.id">

                <div @click="selectVariantCate(i.id)" class="w-10 h-10 flex items-center justify-center flex-none rounded-md border border-gray-300 " :class="{ 'border-primary-900 text-primary-900' : (selectedCate == i.id), 'dark:border-neutral-700' : (selectedCate != i.id) }">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                      </svg>                      
                </div>
                
                <div @click="setCateVariantAsMain(i.id)" class="w-10 h-10 flex items-center justify-center flex-none rounded-md border border-gray-300 " :class="{ 'border-primary-900 text-primary-900' : (i.with_images), 'dark:border-neutral-700' : (selectedCate != i.id) }">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shadow-md w-6 h-6">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>                 
                </div>
                
                <InputComponent v-model:value="i.value" @field-data.once="fieldsData" type="text" :inputData="{
                    'name' : '',
                    'isHeader' : false,
                    'placeholder' : '{{ trans('Category name') }}',
                    validate : ['Required'],
                }" ></InputComponent>

                <div class="flex flex-none w-10 h-10 border rounded-md dark:border-neutral-700 border-gray-300 shadow-md items-center justify-center" @click="deleteVariantCate(i.id)" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                      </svg>                
                </div>
            </div>
        </div>

        <div v-if="variantsData.cates.length < 3" class="flex flex-wrap mt-5">
            <div class="flex py-1 px-3 bg-transparent text-primary rounded-md" @click="addVariantCate" data-mdb-ripple="true" data-mdb-ripple-color="dark">
                {{__('Add product variant category')}}
            </div>
        </div>

    </section>

</div>

<div class="flex flex-col w-3/5 p-6">

    <section 
        v-if="variantsData.cates.length == 0 && 
        variantsData.variants.find((e) => {return e.cate == variantsData.mainVariant})" 
        class="w-full flex flex-col border-b border-gray-300 dark:border-neutral-700 mb-5 pb-5"
    >
        <section 
            :aria-labelledby="'variante-image-heading'+variantsData.mainVariant" 
            :aria-describedby="'variante-image-details'+variantsData.mainVariant"
        >
            <h2 
                :id="'variante-image-heading'+variantsData.mainVariant" 
                class="text-lg font-semibold"
            >
                {{__('Variant Image')}}
            </h2>
    
            <p 
                class="mb-2" 
                :id="'variante-image-details'+variantsData.mainVariant"
            >
                {{__('A photo that match with the variant')}}
            </p>
            
            <UploadComponent 
                v-model:value="variantsData.variants.find((e) => {return e.cate == variantsData.mainVariant}).image" 
                @field-data.once="fieldsData" 
                :required="true" 
                :multiple="false" 
                accept="image/*" 
                name="variante-image" 
                :id="'variante-image' + variantsData.mainVariant"
            >
                <template #default="{image, data}">
                    <div 
                        class="w-24 h-24 rounded-md border overflow-hidden flex justify-center items-center relative" 
                        :class="(data.error)? 'border-red-600' : 'border-gray-300'"
                    >
                        <label 
                            :for="'variante-image' + variantsData.mainVariant" 
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

        <hr class="my-5">

        <section 
            :aria-labelledby="'variante-des-heading'+variantsData.mainVariant" 
            :aria-describedby="'variante-des-details'+variantsData.mainVariant"
        >
            <h2 
                :id="'variante-des-heading'+variantsData.mainVariant"
                class="text-lg font-semibold"
            >
                {{__('Variant description')}}
            </h2>
    
            <p 
                class="mb-2" 
                :id="'variante-des-details'+variantsData.mainVariant"
            >
                {{__('A description that describe the unique aspect of this variante')}}
            </p>
            
            <InputComponent v-model:value="variantsData.variants.find((e) => {return e.cate == variantsData.mainVariant}).des" type="textarea" :inputData="{
                'name' : 'variante_des',
                'isHeader' : true,
                'placeholder' : '{{ trans('Variant Description') }}',
            }" >
            </InputComponent>
            
        </section>


        <hr class="my-5">
        
        <section 
            :aria-labelledby="'variante-images-heading'+variantsData.mainVariant" 
            :aria-describedby="'variante-images-details'+variantsData.mainVariant"
        >
            <h2 
                :id="'variante-images-heading'+variantsData.mainVariant" 
                class="text-lg font-semibold"
            >
                {{__('Variante images')}}
            </h2>
    
            <p 
                class="mb-2" 
                :id="'variante-images-details'+variantsData.mainVariant"
            >
                {{__('Add diferents images to describe the variant. 500 x 500 or 1000 x 1000 to improve the image cuality')}}
            </p>
            
            <UploadComponent 
                v-model:value="variantsData.variants.find((e) => {return e.cate == variantsData.mainVariant}).images" 
                :multiple="true" 
                accept="image/*" 
                name="variante_images" 
                :id="'variante-images'+variantsData.mainVariant"
            >
                <template #default="{ images, deleteImage }">
                    <div class="flex flex-wrap flex-row">

                        <div class="w-24 h-24 rounded-md m-2 border border-gray-300 overflow-hidden flex justify-center items-center relative">
                            <label 
                                :for="'variante-images'+variantsData.mainVariant" 
                                class="w-full h-full z-10 absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                                </svg>                                                                       
                            </label>
                        </div>
                        
                        <div 
                            v-for="image in images" 
                            class="w-24 h-24 rounded-md m-2 border border-gray-300 overflow-hidden flex justify-center items-center relative"
                        >
                            <div 
                                class="absolute shadow-lg z-10 w-10 h-10 right-1 top-1 rounded-full bg-white dark:bg-dark dark:text-white flex items-center justify-center" 
                                data-mdb-ripple="true" 
                                data-mdb-ripple-color="dark" 
                                @click="deleteImage(image.image)"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>                                              
                            </div>
                            <img 
                                :src="image.path" 
                                class="w-full h-full" 
                                alt="Uploaded Image for variante"
                            >
                        </div>
                    </div>
                </template>
            </UploadComponent>
            
        </section>
    </section>

    {{-- When there is multiple cates and variants --}}
    <div class="w-full flex" :key="ii.id" v-for="ii in variantsData.cates">
        <div class="w-full flex flex-col" v-show="selectedCate == ii.id">

            <h1 class="text-lg font-semibold">
                {{__('Product category name')}}
            </h1>

            <p 
                v-text="ii.value">
            </p>

            <hr class="my-5">

            <section 
                class="w-full flex flex-col border-b border-gray-300 dark:border-neutral-700 mb-5 pb-5" 
                :key="i.id" 
                v-for="i in variantsData.variants.filter((element) => { return element.cate == ii.id })"
            >
                <section 
                    :aria-labelledby="'variante-name-heading' + i.id" 
                    :aria-describedby="'variante-name-details' + i.id">
                    
                    <div class="flex flex-row justify-between">
                        
                        <h2 
                            :id="'variante-name-heading' + i.id" 
                            class="text-lg font-semibold"
                        >
                            {{__('Variant name')}}
                        </h2>

                        <div 
                            v-if="variantsData.variants.filter((element) => { return element.cate == ii.id }).length > 1"
                        >
                            <div 
                                class="flex bg-transparent text-primary py-2 px-5 rounded-md" 
                                @click="deleteVariant(i.id)" 
                                data-mdb-ripple="true" 
                                data-mdb-ripple-color="dark"
                            >
                                {{__('Delete variant')}}
                            </div>
                        </div>
                    </div>
            
                    <p class="mb-2" :id="'variante-name-details'+i.id">
                        {{__('Name of the variant')}}
                    </p>
                    
                    <InputComponent 
                        v-model:value="i.name" 
                        @field-data.once="fieldsData" 
                        type="text" 
                        :inputData="{
                            'name' : 'variante_name',
                            'isHeader' : true,
                            'placeholder' : '{{ trans('Variant name') }}',
                            'validate' : ['Required'],
                        }" 
                    >
                    </InputComponent>
                    
                </section>
                
                <div 
                    class="flex flex-col w-full" 
                    v-if="ii.with_images"
                >
                    <hr class="my-5">
                    
                    <section
                        :aria-labelledby="'variante-image-heading'+i.id" 
                        :aria-describedby="'variante-image-details'+i.id"
                    >
                        <h2 
                            :id="'variante-image-heading'+i.id" 
                            class="text-lg font-semibold"
                        >
                            {{__('Variant image')}}
                        </h2>
                
                        <p class="mb-2" :id="'variante-image-details'+i.id">
                            {{__('A photo that match with the variant')}}
                        </p>
                        
                        <UploadComponent 
                            v-model:value="i.image" 
                            @field-data.once="fieldsData" 
                            :required="true" 
                            :multiple="false" 
                            accept="image/*" 
                            name="variante_image" 
                            :id="'variante-image' + i.id"
                        >
                            <template #default="{image, data}">
                                <div 
                                    class="w-24 h-24 rounded-md border overflow-hidden flex justify-center items-center relative" 
                                    :class="(data.error)? 'border-red-600' : 'border-gray-300'"
                                >
                                    <label 
                                        :for="'variante-image' + i.id" 
                                        class="w-full h-full z-10 absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shad
                                            ow-md w-6 h-6">
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
            
                    <hr class="my-5">
            
                    <section
                        :aria-labelledby="'variante-des-heading'+i.id" 
                        :aria-describedby="'variante-des-details'+i.id"
                    >
                        <h2 :id="'variante-des-heading'+i.id" class="text-lg font-semibold">
                            {{__('Variant description')}}
                        </h2>
                
                        <p class="mb-2" :id="'variante-des-details'+i.id">
                            {{__('A description that describe the unique aspect of this variante')}}
                        </p>
                        
                        <InputComponent v-model:value="i.des" type="textarea" :inputData="{
                            'name' : 'variante_des',
                            'isHeader' : true,
                            'placeholder' : '{{ trans('Variant description') }}',
                        }" >
                        </InputComponent>
                        
                    </section>


                    <hr class="my-5">
                    
                    <section
                        :aria-labelledby="'variante-images-heading'+i.id" 
                        :aria-describedby="'variante-images-details'+i.id"
                    >
                        <h2 
                            :id="'variante-images-heading'+i.id" 
                            class="text-lg font-semibold"
                        >
                            {{__('Variant images')}}
                        </h2>
                
                        <p class="mb-2" :id="'variante-images-details'+i.id">
                            {{__('Add diferents images to describe the variant. 500 x 500 or 1000 x 1000 to improve the image cuality')}}
                        </p>
                        
                        <UploadComponent 
                            v-model:value="i.images" 
                            :multiple="true" 
                            accept="image/*" 
                            name="variante_images" 
                            :id="'variante-images'+i.id"
                        >
                            <template #default="{ images, deleteImage }">
                                <div class="flex flex-wrap flex-row">

                                    <div class="w-24 h-24 rounded-md m-2 border border-gray-300 overflow-hidden flex justify-center items-center relative">
                                        <label 
                                            :for="'variante-images'+i.id" 
                                            class="w-full h-full z-10 absolute top-0 left-0 right-0 bottom-0 flex items-center justify-center"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                                            </svg>                                                                       
                                        </label>
                                    </div>
                                    
                                    <div 
                                        v-for="image in images" 
                                        class="w-24 h-24 rounded-md m-2 border border-gray-300 overflow-hidden flex justify-center items-center relative"
                                    >
                                        <div 
                                            class="absolute shadow-lg z-10 w-10 h-10 right-1 top-1 rounded-full bg-white dark:bg-dark dark:text-white flex items-center justify-center"
                                            data-mdb-ripple="true" 
                                            data-mdb-ripple-color="dark" 
                                            @click="deleteImage(image.image)"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                              </svg>                                              
                                        </div>
                                        <img 
                                            :src="image.path" 
                                            class="w-full h-full" 
                                            alt="Uploaded Image for variante"
                                        >
                                    </div>
                                </div>
                            </template>
                        </UploadComponent>
                        
                    </section>

                    
                </div>
        
            </section>

            <div 
                class="flex" 
                v-if="variantsData.variants.filter((element) => { return element.cate == ii.id }).length < 4"
            >
                <div 
                    class="flex bg-transparent text-primary py-2 px-5 rounded-md" 
                    @click="addVariant({cate: ii.id})" 
                    data-mdb-ripple="true" 
                    data-mdb-ripple-color="dark"
                >
                    {{__('Add variant')}}
                </div>

            </div>

        </div>
    </div>

</div>