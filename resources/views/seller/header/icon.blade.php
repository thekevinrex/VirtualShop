<Link href="{{ (Auth::guard('seller')->check() && !Auth::guard('seller')->user()->isNotStartUp() )? route('seller.dashboard') : route('seller.home') }}">
    <img class="h-12 w-40" src="{{ Vite::asset('resources/images/red_logo.png') }}" alt="Application Logo">
</Link>