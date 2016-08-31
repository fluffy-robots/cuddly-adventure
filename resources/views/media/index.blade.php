@extends('layouts.main')

@section('content')
    <media-browser csrf_token="{{ csrf_token() }}"></media-browser>
@endsection