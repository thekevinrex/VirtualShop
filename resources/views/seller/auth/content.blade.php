@extends('seller.layaut.authContainer')

@section('content')
    
    <div class="flex flex-row w-full">

        <div class="flex basis-[450px] w-[450px] flex-shrink-0 flex-grow-0 flex-none border-r border-gray-300 flex-col py-12 px-10 space-y-3 relative">
            
            <div>
                @include('header.icon')
            </div>

            @yield('auth-form')

        </div>

        <div class="flex w-full h-screen max-h-screen justify-center items-center">
            <img src="{{ Vite::asset('resources/images/mercado-back.jpg') }}" class="w-full h-full" alt="" srcset="">
        </div>
    </div>

@endsection