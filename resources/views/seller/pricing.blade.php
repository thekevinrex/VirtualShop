@extends('seller.layaut.docsContainer')

@section('content')

<div class="flex w-full relative h-auto bg-blue-200">

    <div class="max-w-3/5 flex flex-col p-20">
        
        <h1 class="text-6xl font-bold tracking-tight">
            How moch cost selling
        </h1>

        <p class="text-lg font-semibold tracking-tight mt-5">
            El coste de vender depende de tu plan de ventas, categoria del producto y la estrategia de logistica. <br>
            Las opciones son flexibles, encuentra la mejor combinacion que se adapte a ti
        </p>

    </div>

</div>

<div class="flex flex-row flex-wrap w-full justify-center relative h-auto min-h-[350px] bg-blue-200">

    <div class="bg-white w-[280px] m-5 rounded-xl border flex flex-col border-gray-300 p-8 space-y-4 z-10">
        <h1 class="text-xl font-bold">
            Plan de ventas
        </h1>

        <p class="text-sm font-semibold">
            Con el plan individual pagaras $1 por cada producto vendido. Y con el plan profesional pagaras $40 al mes sin importar cuantos productos vendas
        </p>
    </div>

    <div class="bg-white w-[280px] m-5 rounded-xl border flex flex-col border-gray-300 p-8 space-y-4 z-10">
        <h1 class="text-xl font-bold">
            Categoria del producto
        </h1>

        <p class="text-sm font-semibold">
            Se cobra una tarifa por referencia por cada producto vendido. La cantidad depende de la categoría del producto. La mayoría de las tarifas por referencia están entre el 8 % y el 15 %.
        </p>
    </div>

    <div class="bg-white w-[280px] m-5 rounded-xl border flex flex-col border-gray-300 p-8 space-y-4 z-10">
        <h1 class="text-xl font-bold">
            Tarifa de gestion logistica
        </h1>

        <p class="text-sm font-semibold">
            El coste del envío de tus pedidos depende de si gestionas tus propios pedidos o si utilizas nuestro servicio de entrega
        </p>
    </div>

    <svg alt="" class="absolute bottom-0 left-0 right-0 w-full z-0" height="354px" preserveAspectRatio="none" role="presentation" version="1.1" viewBox="0 0 1440 354" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0,351.933506 C116,262.863915 341.333333,211.08769 676,196.604829 C1010.66667,182.121969 1265.33333,116.587026 1440,0 L1440,354 L0,353.994109 L0,351.933506 Z" fill="#fff"></path></g></svg>
</div>


<div class="w-full flex flex-col relative items-center justify-center">

    <svg alt="" class="-scale-x-100 w-full" height="278px" preserveAspectRatio="none" role="presentation" version="1.1" viewBox="0 0 1440 278" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0,260.670469 C268,291.980818 533.333333,258.847538 796,161.270627 C1058.66667,63.6937169 1273.33333,9.93684108 1440,0 L1440,278 L0,278 L0,260.670469 Z" class="fill-green-300" transform="translate(720.000000, 139.000000) scale(-1, 1) translate(-720.000000, -139.000000) "></path></g></svg>

    <div class="flex basis-96 w-full h-96 bg-green-300">
        

        {{-- <img src="{{ Vite::asset('resources/images/back.jpg') }}" alt="Pricing back image" class="flex-none w-full h-full"> --}}
    </div>

    <div class="w-3/5 h-auto -mt-72">
        @include('seller.docs.pricing-plans')
    </div>

    
</div>
    
<div class="w-full flex justify-center">
    <div class="w-full max-w-screen-xl flex">
        @include('seller.docs.pricing-caracteristic')
    </div>
</div>

<div class="bg-blue-200">
    <svg alt="" class="-scale-100 w-full z-0" height="99px" preserveAspectRatio="none" role="presentation" version="1.1" viewBox="0 0 1440 99" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0,9.96853624 C188.794063,104.871486 434.285714,119.996643 736.474954,55.3440089 C1038.66419,-9.30862535 1273.17254,-17.3160617 1440,31.3216998 L1440,99 L0,99 L0,9.96853624 Z" fill="#fff"></path></g></svg>
</div>

<div class="flex w-full relative h-auto bg-blue-200">


    <div class="max-w-3/5 flex flex-col p-20">
        
        <h1 class="text-6xl font-bold tracking-tight">
            Tarifas por referencia de categorías
        </h1>

        <p class="text-lg font-semibold tracking-tight mt-5">
            Los vendedores pagan una tarifa por referencia por cada producto vendido. Para todos los productos, Se deduce el porcentaje de la tarifa por referencia aplicable calculado en función del precio total de venta. El precio total de venta es el importe total pagado por el comprador, incluido el precio del producto y cualquier cargo de envío o envoltorio para regalo.
        </p>

    </div>

    Listado de todas las categorias y su precio y minimo
</div>

<div class="flex flex-row flex-wrap w-full justify-center relative h-auto min-h-[350px] bg-blue-200">
    <svg alt="" class="absolute bottom-0 left-0 right-0 w-full z-0" height="354px" preserveAspectRatio="none" role="presentation" version="1.1" viewBox="0 0 1440 354" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0,351.933506 C116,262.863915 341.333333,211.08769 676,196.604829 C1010.66667,182.121969 1265.33333,116.587026 1440,0 L1440,354 L0,353.994109 L0,351.933506 Z" fill="#fff"></path></g></svg>
</div>



@endsection