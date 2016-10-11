@extends('layouts.main')

@section('content')
    <media-browser media_list="{{ $files }}"></media-browser>
@endsection