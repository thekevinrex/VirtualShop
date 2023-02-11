@extends('seller.auth.content')

@section('auth-form')

<h1 class="font-bold text-3xl">
    @lang('auth.confirm_password')
</h1>

<x-form class="mt-4 space-y-6 bg-white relative" action="{{ url('/seller-panel/password-confirm') }}" method="post">
            
    <x-slot:footer>
        <button type="submit" class="relative flex w-full justify-center rounded-md border border-transparent disabled:bg-indigo-300 bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            @lang('auth.confirm_password')
        </button>
    </x-slot>

    <div class="flex flex-col">
        
        <InputComponent v-model:value="form.password" type="password" :inputData="{
            'name' : 'password',
            'front_icon' : true,
            'isHeader' : true,
            'placeholder' : '{{ trans_choice('auth.password', 0) }}',
        }">
            <template #front-icon><svg viewBox="0 0 24 24" style="pointer-events: none; display: block; width: 100%; height: 100%;"><g><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"></path></g></svg></template>
        </InputComponent>

    </div>
    
    <div class="flex items-center justify-between">
        <div class="text-sm">
            <Link href="/seller-plan/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">@lang('auth.forgot_password')</Link>
        </div>
    </div>
    
</x-form>
@endsection