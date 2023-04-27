<Link href="{{ (Auth::check() && $sellerService->isStartUp() )? route('seller.dashboard') : route('seller.home') }}">
    <img class="h-12 w-40" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Application Logo">
</Link>