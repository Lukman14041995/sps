@extends('layouts.frontend')

@section('content')
    <x-hero />

    {{-- <x-greetings /> --}}

    <x-about-section />

    <x-vision-mission />

    <x-business />

    <x-logo-section />

    <x-news :latestNews="$latestNews" />

    <x-join-section />
@endsection
