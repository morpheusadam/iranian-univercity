@extends('layouts.app')

@section('title', 'ایجاد بازه زمانی جدید')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('time-periods.store') }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('post')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="period" class="form-label">بازه زمانی (ساعت کلاس):</label>
                <input type="name" name="period" class="form-control @error('period') is-invalid @enderror" id="period" placeholder="بازه زمانی را وارد کنید" value="{{ old('period') }}">
                @error('period')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <div class="form-text">برای مثال 12.45-10</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
