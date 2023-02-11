@extends('seller.auth.content')

@section('auth-form')
<div class="tracking-tight">
    {{ __('Before proceeding, please check your email for a verification link.') }}
    {{ __('If you did not receive the email') }},
</div>

<div class="flex flex-row justify-between"> 
    <x-form action="{{ route('seller.verification.send') }}" method="post">
        <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            @lang('auth.resend_email')
        </button>
    </x-form>

    <form action="{{ route('seller.logout') }}" method="post">
        @csrf
        <button type="submit" class="relative flex justify-center rounded-md border border-transparent disabled:bg-gray-300 bg-gray-500 py-2 px-4 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
            @lang('auth.logout')
        </button>
    </form>
</div>
@endsection