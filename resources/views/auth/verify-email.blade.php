@extends('auth.bubbles.primary')

@section('auth-form')

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Your Company">

            <h2 class="mt-6 text-4xl font-bold tracking-tight text-gray-900">
                @lang('auth.verify_your_email')
            </h2>

        </div>

        <x-splade-event private channel="verified-{{ Auth::user()->getKey() }}" listen="RedirectOnVerified" />


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
            
            <form action="{{ route('verification.send') }}" method="post">
                @csrf
                <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    @lang('auth.resend_email')
                </button>
            </form>
        </div>
        

    </div>
</div>

@endsection