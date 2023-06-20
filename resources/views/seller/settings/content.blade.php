@extends('seller.layauts.container')

@section('content')


    @includeWhen($view == 'info', 'seller.settings.fields.info')
    @includeWhen($view == 'payment', 'seller.settings.fields.payment')
    @includeWhen($view == 'address', 'seller.settings.fields.address')
    
@endsection