@extends('layouts.app')

@section('title', 'ایجاد ورودی جدید')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('entries.store') }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('post')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="year" class="form-label">سال ورودی :</label>
                <input type="name" name="year" class="form-control @error('year') is-invalid @enderror" id="year" placeholder="سال ورودی را وارد کنید" value="{{ old('year') }}">
                @error('year')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
