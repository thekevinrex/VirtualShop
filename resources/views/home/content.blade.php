@extends ("layouts.container")

@section('content')
asdas
@auth
{{ Auth::viaRemember() }}
@endauth

@endsection
