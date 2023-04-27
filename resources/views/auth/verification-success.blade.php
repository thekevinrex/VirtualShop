@extends('auth.bubbles.primary')

@section('auth-form')

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <Link href="{{ route('home') }}">
                <img class="mx-auto h-12 w-auto" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Your Company">
            </Link>

            <h2 class="mt-6 text-4xl font-bold tracking-tight text-green-500">
                {{ __('Your email address has been successfully verificated') }}
            </h2>

        </div>
        

    </div>
</div>

@endsection