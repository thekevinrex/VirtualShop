@extends('layaut.container');

@section('content')
    login
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember-me" name="remember_me" v-model="form.remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                @lang('auth.remember_me')
            </label>
        </div>

        <div class="text-sm">
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
        </div>
    </div>
@endsection