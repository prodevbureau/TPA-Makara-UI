@extends('layout/master')

@section('title', 'List Student Kelas Bermain - GURU')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <div class="d-flex justify-content-center">
        <h1 class = "daftarsiswa-title underliner">
            Daftar Tipe Kelas
        </h1>
    </div>

    <div class="centerer">
        @if($route == 'profile')
        <a class="linkclass" href="{{ route('profile.student', ['class' => 'DayCare']) }}">
        @else
        <a class="linkclass" href="{{ route('dailyBook.student', ['class' => 'DayCare']) }}">
        @endif
            <img src="{{asset('svg/daycare.svg')}}" alt="daycare">
            <h1 class="typeclass">Daycare</h1>
        </a>

        @if($route == 'profile')
        <a class="linkclass" href="{{ route('profile.student', ['class' => 'KelompokBermain']) }}">
        @else
        <a class="linkclass" href="{{ route('dailyBook.student', ['class' => 'KelompokBermain']) }}">
        @endif
            <img src="{{asset('svg/kelompokbermain.svg')}}" alt="kelompok bermain">
            <h1 class="typeclass">Kelompok Bermain</h1>
        </a>
    </div>

@endsection

@section('extra-js')

@endsection
