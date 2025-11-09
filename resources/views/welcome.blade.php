@extends('layouts.app')

@section('title', 'unesa 5 medical care')

{{-- Ini adalah konten utama halaman --}}
@section('content')
    
    {{-- Memuat setiap bagian (section) landing page --}}
    
    @include('partials.hero')
    
    @include('partials.services')
    
    @include('partials.about')

    @include('partials.contact')

@endsection
