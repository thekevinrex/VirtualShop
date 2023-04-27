@extends('auth.bubbles.primary')

@section('auth-form')

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div class="flex flex-col justify-center">

            <Link href="{{ route('home') }}">
                <img class="mx-auto h-12 w-auto" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Virtual shop icon">
            </Link>

            <h2 class="mt-6 text-center text-4xl font-bold tracking-tight text-gray-900">
                {{__('Sign in into your account')}}
            </h2>
        </div>

        <x-form class="mt-8 space-y-6 bg-white dark:bg-dark dark:text-white p-8 rounded-xl relative" action="{{ url('/login') }}" method="post">
            
            <x-slot:footer class="flex-col justify-center">
                <button type="submit" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{__('Sign in')}}
                </button>
                <span class="text-center mt-2">
                    {{ __('Or')}}
                    <Link href="{{ route('auth.register') }}">{{ __('Sign up') }}</Link>
                </span>
            </x-slot>

            <div class="flex flex-col">
                
                <InputComponent v-model:value="form.username" type="text" :inputData="{
                    'name' : 'username',
                    'front_icon' : true,
                    'isHeader' : true,
                    'placeholder' : '{{ __('Username') }}',
                }" >
                    <template #front-icon><svg width="100%" height="100%" viewBox="0 0 24 24"><path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"></path></svg></template>
                </InputComponent>

                <InputComponent v-model:value="form.password" type="password" :inputData="{
                    'name' : 'password',
                    'front_icon' : true,
                    'isHeader' : true,
                    'placeholder' : '{{ trans_choice('Password', 0) }}',
                }">
                    <template #front-icon><svg viewBox="0 0 24 24" style="pointer-events: none; display: block; width: 100%; height: 100%;"><g><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"></path></g></svg></template>
                </InputComponent>

            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember_me" v-model="form.remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="remember-me" class="ml-2 block text-sm">
                        {{__('Remember me')}}
                    </label>
                </div>
        
                <div class="text-sm">
                    <Link href="/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">{{__('Forgot Password')}}</Link>
                </div>
            </div>
            
        </x-form>

    </div>
</div>

@endsection