@extends('seller.auth.content')

@section('auth-form')
<div class="tracking-tight dark:text-white">
    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
</div>

<x-splade-state>
    <div class="flex flex-col w-full bg-green-700 rounded-md" v-if="state.hasFlash('status')">
        <div class="w-full py-1 px-3 my-1 mx-1">
            <div class="text-sm text-white">
                @{{ state.flash.status }}
            </div>
        </div>
    </div>
</x-splade-state>

<div class="flex flex-row justify-between"> 
    <x-splade-form action="{{ route('seller.verification.send') }}" method="post">
        <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            @lang('auth.resend_email')
        </button>
    </x-splade-form>

    <form action="{{ route('seller.logout') }}" method="post">
        @csrf
        <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-gray-300 bg-gray-500 py-2 px-4 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            @lang('auth.logout')
        </button>
    </form>
</div>
@endsection