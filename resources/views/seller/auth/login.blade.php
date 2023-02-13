@extends('seller.auth.content')

@section('auth-form')

<h1 class="font-bold text-3xl dark:text-white">
    @lang('auth.sign_in')
</h1>

<x-form class="mt-4 space-y-6 bg-white dark:bg-dark" action="{{ url('/seller-panel/login') }}" method="post">

    <x-slot:footer class="flex-col justify-center dark:text-white">
        <button type="submit" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            @lang('auth.sign_in')
        </button>
        <span class="text-center mt-2">
            @lang('auth.or')
            <Link href="{{ route('seller.auth.register') }}">@lang('auth.sign_up')</Link>
        </span>
    </x-slot>

    <div class="flex flex-col">
        
        <InputComponent v-model:value="form.username" type="text" :inputData="{
            'name' : 'username',
            'front_icon' : true,
            'isHeader' : true,
            'placeholder' : '{{ trans('auth.email') }}',
        }" >
            <template #front-icon><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-full h-full"><path d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" /><path d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" /></svg></template>
        </InputComponent>

        <InputComponent v-model:value="form.password" type="password" :inputData="{
            'name' : 'password',
            'front_icon' : true,
            'isHeader' : true,
            'placeholder' : '{{ trans_choice('auth.password', 0) }}',
        }">
            <template #front-icon><svg viewBox="0 0 24 24" style="pointer-events: none; display: block; width: 100%; height: 100%;"><g><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"></path></g></svg></template>
        </InputComponent>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember-me" name="remember_me" v-model="form.remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="remember-me" class="ml-2 block text-sm text-gray-900 dark:text-white">
                    @lang('auth.remember_me')
                </label>
            </div>
    
            <div class="text-sm">
                <Link href="/seller-panel/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">@lang('auth.forgot_password')</Link>
            </div>
        </div>
    </div>
    
</x-form>
@endsection