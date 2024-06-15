@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')
    <div class="container">
        @if (session('login-success'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('login-success') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mt-2">
            <div class="mb-4">
                <div class="mb-2 pe-3">تعداد دروس :</div>
                <h1 class="col"><span class="py-4 w-100 shadow-sm badge bg-danger"><i class="bi bi-book"></i> {{ $lessons_count }}</span></h1>
            </div>
            <div class="mb-4">
                <div class="mb-2 pe-3">تعداد اساتید :</div>
                <h1 class="col"><span class="py-4 w-100 shadow-sm badge bg-success"><i class="bi bi-people"></i> {{ $professors_count }}</span></h1>
            </div>
            <div class="mb-4">
                <div class="mb-2 pe-3">تعداد گروه های آموزشی :</div>
                <h1 class="col"><span class="py-4 w-100 shadow-sm badge bg-warning"><i class="bi bi-mortarboard"></i> {{ $egs_count }}</span></h1>
            </div>
            <div class="mb-4">
                <div class="mb-2 pe-3">تعداد ورودی ها :</div>
                <h1 class="col"><span class="py-4 w-100 shadow-sm badge bg-primary"><i class="bi bi-calendar-date"></i> {{ $entries_count }}</span></h1>
            </div>
            <div class="mb-4">
                <div class="mb-2 pe-3">تعداد کلاس ها :</div>
                <h1 class="col"><span class="py-4 w-100 shadow-sm badge bg-secondary"><i class="bi bi-easel"></i> {{ $classes_count }}</span></h1>
            </div>
            <div class="mb-4">
                <div class="mb-2 pe-3">تعداد مکان های برگزاری :</div>
                <h1 class="col"><span class="py-4 w-100 shadow-sm badge" style="background-color: purple"><i class="bi bi-pin-map"></i> {{ $locations_count }}</span></h1>
            </div>
        </div>
    </div>
@endsection
