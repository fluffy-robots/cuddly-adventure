@extends('layouts.main')

@section('content')
    <product-types product_types="{{$product_types}}" field_types="{{$field_types}}"></product-types>
@endsection