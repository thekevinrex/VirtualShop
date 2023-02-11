@extends('seller.auth.content')

@section('auth-form')

<h1 class="font-bold text-3xl">
    @lang('auth.register')
</h1>

<p>
    @lang('auth.register_seller_info')
</p>

<x-form class="mt-8 space-y-6 bg-white relative" action="{{ url('/seller-panel/register') }}" method="post">

    <x-slot:footer class="flex-col">
        <button type="submit" :disabled="!form.terms_policies" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            @lang('auth.sign_up')
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

        <InputComponent v-model:value="form.password" type="password" :inputData="{
            'name' : 'password',
            'front_icon' : true,
            'isHeader' : true,
            'placeholder' : '{{ trans_choice('auth.password', 0) }}',
            'validate' : ['Required', 'Password'],
        }">
            <template #front-icon><svg viewBox="0 0 24 24" style="pointer-events: none; display: block; width: 100%; height: 100%;"><g><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"></path></g></svg></template>
            <template #errors="{ errorsType }">
                <div class="text-sm flex" v-if="errorsType.includes('Password-symbols')">
                    @lang('validation.password.symbols', ['attribute' => strtolower(trans_choice('auth.password', 0) ), ])
                </div>
                <div class="text-sm flex" v-if="errorsType.includes('Password-mixed')">
                    @lang('validation.password.mixed', ['attribute' => strtolower(trans_choice('auth.password', 0) ), ])
                </div>
                <div class="text-sm flex" v-if="errorsType.includes('Password-numbers')">
                    @lang('validation.password.numbers', ['attribute' => strtolower(trans_choice('auth.password', 0) ), ])
                </div>
                <div class="text-sm flex" v-if="errorsType.includes('Password-length')">
                    @lang('validation.between.string', ['attribute' => strtolower(trans_choice('auth.password', 0) ), 'min' => 8, 'max' => 20 ])
                </div>
            </template>
        </InputComponent>

        <InputComponent v-model:value="form.password_confirmation" :confirm="form.password" type="password" :inputData="{
            'name' : 'password_confirmation',
            'front_icon' : true,
            'isHeader' : true,
            'placeholder' : '{{ trans_choice('auth.password', 1) }}',
            validate : ['Required', 'Confirm'],
        }">
            <template #front-icon><svg viewBox="0 0 24 24" style="pointer-events: none; display: block; width: 100%; height: 100%;"><g><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"></path></g></svg></template>
            <template #errors="{ errorsType }">
                <div class="text-sm flex" v-if="errorsType.includes('Confirm')">
                    @lang('validation.confirmed', ['attribute' => strtolower(trans_choice('auth.password', 0) ), ])
                </div>
            </template>
        </InputComponent>

    </div>

    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="terms_policies" name="terms_policies" v-model="form.terms_policies" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <label for="terms_policies" class="ml-2 block text-sm text-gray-900">
                @lang('auth.terms_policies', ['terms' => '<Link href="/terms">'. trans('auth.terms') .'</Link>', 'policies' => '<Link href="/policies">'. trans('auth.policies') .'</Link>' ])
            </label>
        </div>
    </div>

</x-form>
@endsection