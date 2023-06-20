<section aria-labelledby="product-name-heading" aria-describedby="product-name-details">

    <h1 id="product-name-heading" class="text-lg font-semibold flex justify-between items-center">
        <div>
            {{__('Product Name')}}
        </div>

        <div class="w-10 h-10 flex justify-center items-center mx-2" @click="setToggle(false)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 011.06 0l7.5 7.5a.75.75 0 11-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 01-1.06-1.06l7.5-7.5z" clip-rule="evenodd" />
              </svg>              
        </div>
    </h1>

    <p id="product-name-details" class="mb-2">
        {{__('The name help the buyers to find your product')}}
        {{__('Must include especifict aspects like brand, model, color, size as many others elements')}}
    </p>
    
    <InputComponent v-model:value="data.info.name" @field-data.once="data.fieldsData" type="text" :inputData="{
        'name' : 'name',
        'isHeader' : true,
        'placeholder' : '{{ trans('Product name') }}',
        'validate' : ['Required'],
        'ariaLabelledby' : 'product-name-heading',
    }" >
    </InputComponent>
    
</section>

<hr class="my-5">

<section aria-labelledby="product-des-heading" aria-describedby="product-des-details">

    <h1 id="product-des-heading" class="text-lg font-semibold">
        {{__('Product Description')}}
    </h1>

    <p class="mb-2" id="product-des-details">
        {{__('A detailed description of the product help the buyers to know more abaut this')}}
    </p>

    <InputComponent v-model:value="data.info.description" type="textarea" :inputData="{
        'name' : 'description',
        'isHeader' : true,
        'placeholder' : '{{ trans('Product Description') }}',
        'ariaLabelledby' : 'product-des-heading',
    }" ></InputComponent>
</section>

<hr class="my-5">

<section aria-labelledby="product-info-heading" aria-describedby="product-info-details">

    <div class="flex flex-row justify-between">
        <h1 id="product-info-heading" class="text-lg font-semibold">
            {{__('Product Information')}}
        </h1>

        <div class="flex py-1 px-3 bg-transparent text-primary rounded-md" @click="data.addInfo" data-mdb-ripple="true" data-mdb-ripple-color="dark">
            {{__('Add Information')}}
        </div>
    </div>

    <p class="mb-2" id="product-info-details">
        {{__('Short, descriptive sentences highlighting key features and benefits')}}
    </p>

    <div class="flex flex-col w-full">
        <div class="flex flex-row space-x-3" v-for="i in data.info.details" :key="i.keyUuid">

            <div class="w-40 flex-none">
                <InputComponent v-model:value="i.key" @field-data="data.fieldsData" type="text" :inputData="{
                    'name' : 'info_key',
                    'isHeader' : false,
                    'placeholder' : '{{ trans('Key') }}',
                    'validate' : ['Required'],
                }" ></InputComponent>
            </div>
            
            <InputComponent v-model:value="i.value" @field-data="data.fieldsData" type="text" :inputData="{
                'name' : 'info_value',
                'isHeader' : false,
                'placeholder' : '{{ trans('Value') }}',
                'validate' : ['Required'],
            }" ></InputComponent>

            <div class="flex flex-none w-10 h-10 border rounded-md dark:border-neutral-700 border-gray-300 shadow-md items-center justify-center" @click="data.deleteInfo(i.keyUuid)" data-mdb-ripple="true" data-mdb-ripple-color="dark">
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
        {{__('Restrict Age')}}
    </h1>

    <p class="mb-2" id="product-restrict-details">
        {{__('Ask for age confirmation to limit the view of the product to under age buyers ')}}
    </p>

    <div class="flex items-center">
        <input id="restrict_age" name="restricted_age" v-model="data.info.restricted_age" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
        <label for="restrict_age" class="ml-2 block text-sm text-gray-900 dark:text-white">
            {{__('Restrict the product to age greater of 18 years')}}
        </label>
    </div>

</section>

<hr class="my-5">

<section aria-labelledby="product-fetch-heading" aria-describedby="product-fetch-details">

    <h1 id="product-fetch-heading" class="text-lg font-semibold">
        {{__('Product Videos')}}
    </h1>

    <p class="mb-2" id="product-fetch-details">
        {{__('A video is equal to 1.8 million of words and help that the product sell easier')}}
    </p>

    <div class="flex flex-row">
        <div>
            <InputComponent v-model:value="data.fetchVideo" type="text" :inputData="{
                'name' : 'fetch_video',
                'isHeader' : false,
                'placeholder' : '{{ trans('Fetch video') }}',
                'ariaDescribedby' : 'product-fetch-video',
            }" >
            <template #description>
                <p id="product-fetch-video" class="-mt-4 flex flex-col mb-5 text-sm"> 
                    {{__('Write the url of the video that you want to add (Youtube, or the uploaded videos)')}}
                </p>
            </template>
            </InputComponent>
        </div>

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
        {{__('Product Ratings')}}
    </h1>

    <p class="mb-2" id="product-ratings-details">
        {{__('Select how you want to show the product ratings')}}
    </p>

    <SelectComponent v-model:value="data.info.ratings" :initialData="{{ json_encode($ratings) }}" :inputData="{
        'name' : 'ratings',
        'isHeader' : true,
        'placeholder' : '{{ trans('Ratings') }}',
    }"></SelectComponent>

</section>