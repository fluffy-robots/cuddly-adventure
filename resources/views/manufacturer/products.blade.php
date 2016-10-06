@extends('layouts.main')

@section('content')
    <products products="{{$products}}" product_types="{{$product_types}}"></products>
@endsection