@extends('auth.bubbles.primary')

@section('auth-form')

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <Link href="{{ route('home') }}">
                <img class="mx-auto h-12 w-auto" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Your Company">
            </Link>

            <div class="flex justify-center relative mt-6">
                <div class="rounded-full bg-green-500 h-16 w-16 flex items-center justify-center animate-bounce">
                  <svg class="text-white absolute top-0 right-0 h-full w-full rounded-full" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10.59 14.59L6.7 10.7C6.31 10.31 5.68 10.31 5.29 10.7C4.91 11.08 4.91 11.71 5.29 12.09L9.59 16.39C9.98 16.78 10.61 16.78 11 16.39L18.71 8.7C19.09 8.32 19.09 7.69 18.71 7.31C18.32 6.92 17.69 6.92 17.31 7.31L10.59 14.59Z" />
                  </svg>
                </div>
              </div>
              

            <h2 class="mt-6 text-4xl font-bold tracking-tight text-green-500 text-center">
                {{ __('Your email address has been successfully verificated') }}
            </h2>

        </div>
        

    </div>
</div>

@endsection