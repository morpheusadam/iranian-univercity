@extends('layouts.app')

@section('title', 'ایجاد ترم جدید')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('terms.store') }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('post')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session('warning'))
                <div class="alert alert-warning text-center" role="alert">
                    {{ session('warning') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="number" class="form-label">شماره ترم :</label>
                <input type="name" name="number" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="شماره ترم را وارد کنید" value="{{ old('number') }}">
                @error('number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
