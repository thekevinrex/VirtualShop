@extends ("layouts.container")

@section('content')

<div class="flex w-full relative items-center flex-col h-auto bg-blue-200 dark:bg-indigo-800 dark:text-white">

    <div class="max-w-3/5 flex flex-col p-20">
        
        <h1 class="text-6xl font-bold tracking-tight">
            {{__('Virtual Shop')}}
        </h1>

        <p class="text-lg font-semibold tracking-tight mt-5">
            {{__('This is a virtual shop dedicated to sell and buy products. In our site you can do what ever you want, you chose')}}
        </p>

    </div>

    @if (Auth::check() && !Auth::user()->hasVerifiedEmail())
    <div class="bg-warning w-auto mb-10 -mt-10 p-3 rounded-md">
        {{__('You have not verified your account, check your email.')}}
        <br>
        {{__('If you have not recived any email ')}}
        <Link href="{{ route('verification.notice') }}">{{__('Click here')}}</Link>
    </div>
    @endif

</div>

<div class="flex flex-row flex-wrap w-full justify-center relative h-auto min-h-[300px] bg-blue-200 dark:bg-indigo-800 dark:text-white">

    <div class="bg-white dark:bg-dark dark:border-neutral-700 w-[280px] m-5 rounded-xl border flex flex-col border-gray-300 p-8 space-y-4 z-10">
        <h1 class="text-xl font-bold">
            {{__('Go shopping')}}
        </h1>

        <p class="text-sm font-semibold h-full">
           {{__('Here you can go throw every product uploaded in the site')}}
        </p>

        <Link href="{{ '/' }}" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            {{__('Go shopping')}}
        </Link>
    </div>

    <div class="bg-white dark:bg-dark dark:border-neutral-700 w-[280px] m-5 rounded-xl border flex flex-col border-gray-300 p-8 space-y-4 z-10">
        <h1 class="text-xl font-bold">
            {{__('Become a seller')}}
        </h1>

        <p class="text-sm font-semibold h-full">
            {{__('Here you can become a seller, upload your products and make money')}}
        </p>

        <Link href="{{ 'seller-panel/' }}" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-gray-300 bg-gray-600 py-2 px-4 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            {{__('Start selling today')}}
        </Link>
    </div>


    <svg alt="" class="absolute bottom-0 left-0 right-0 w-full z-0" height="354px" preserveAspectRatio="none" role="presentation" version="1.1" viewBox="0 0 1440 354" xmlns="http://www.w3.org/2000/svg"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><path d="M0,351.933506 C116,262.863915 341.333333,211.08769 676,196.604829 C1010.66667,182.121969 1265.33333,116.587026 1440,0 L1440,354 L0,353.994109 L0,351.933506 Z" class="fill-white dark:fill-dark"></path></g></svg>
</div>


@endsection
