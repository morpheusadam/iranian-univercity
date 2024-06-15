@extends('layouts.app')

@section('title', 'تغییر رمز عبور')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('change-password') }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('put')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control rounde @error('password') is-invalid @enderror" placeholder="رمز عبور">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <input type="password" name="password_confirmation" class="form-control @error('password', 'password_confirmation') is-invalid @enderror" placeholder="تائید رمز عبور">
                @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
