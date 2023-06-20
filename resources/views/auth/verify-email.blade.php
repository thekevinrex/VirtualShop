@extends('auth.bubbles.primary')

@section('auth-form')

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <Link href="{{ route('home') }}">
                <img class="mx-auto h-12 w-auto" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Your Company">
            </Link>

            <h2 class="mt-6 text-4xl font-bold tracking-tight text-gray-900">
                {{__('Verify your email address')}}
            </h2>

        </div>
        
        <x-splade-event private channel="App.Models.User.{{ Auth::user()->id }}" listen="RedirectOnVerified"></x-splade-event>

        <x-splade-state>
            <div class="flex flex-col bg-green-700 rounded-md" v-if="state.hasFlash('message')">
                <div class="w-full py-1 px-3 my-1 mx-1">
                    <div class="text-sm text-white">
                        @{{ state.flash.message }}
                    </div>
                </div>
            </div>
        </x-splade-state>

        <div class="flex flex-col space-y-3">
            <div class="tracking-tight">
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
            </div>
            
            <div class="flex flex-row justify-between"> 
                <x-splade-form action="{{ route('verification.send') }}" method="post">
                    <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 space-x-2">
                        <x-preloader v-if="form.processing" size="pl-size-xx" color="pl-white" wraper="none"></x-preloader>
                        <div>
                        </div>
                        {{__('Resend email')}}
                    </button>
                </x-splade-form>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-gray-300 bg-gray-500 py-2 px-4 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        {{__('Logout')}}
                    </button>
                </form>
            </div>
        </div>
        

    </div>
</div>

@endsection