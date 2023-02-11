@extends('seller.auth.content')

@section('auth-form')

<h1 class="font-bold text-3xl">
    @lang('auth.forgot_password')
</h1>

<x-form class="mt-4 space-y-6 bg-white relative" action="{{ url('/seller-panel/forgot-password') }}" method="post">
            
    <x-slot:footer class="flex-col">
        <button type="submit" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            @lang('passwords.send_reset_email')
        </button>
        <span class="text-center mt-2">
            @lang('auth.or')
            <Link href="{{ route('seller.auth.login') }}">@lang('auth.sign_in')</Link>
        </span>
    </x-slot>

    <div class="flex flex-col">
        
        <InputComponent v-model:value="form.email" type="text" :inputData="{
            'name' : 'email',
            'front_icon' : true,
            'isHeader' : true,
            'placeholder' : '{{ trans('auth.email') }}',
            'validate' : ['Required', 'Email'],
        }" >
            <template #front-icon><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-full h-full"><path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" /><path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" /></svg></template>
            <template #errors="{ errorsType }">
                <div class="text-sm flex" v-if="errorsType.includes('Email')">
                    @lang('validation.email', ['attribute' => strtolower(trans('auth.email') ), ])
                </div>
            </template>
        </InputComponent>

    </div>
    
</x-form>
@endsection