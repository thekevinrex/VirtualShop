@extends('auth.bubbles.primary')

@section('auth-form')

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Your Company">

            <h2 class="mt-6 text-center text-4xl font-bold tracking-tight text-gray-900">
                @lang('password.reset_password')
            </h2>

        </div>

        <x-form class="mt-8 space-y-6 bg-white p-8 rounded-xl relative" action="{{ url('/reset-password') }}" method="post" :default="['email' => $email, 'token' => $token]">
            
            <x-slot:footer>
                <button type="submit" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    @lang('passwords.reset_password')
                </button>
            </x-slot>

            <div class="flex flex-col">
				<input type="hidden" name="token" v-model="form.token">
				<input type="hidden" name="email" v-model="form.email">

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
            
        </x-form>

    </div>
</div>

@endsection