@extends('layouts.app')

@section('title', 'ایجاد درس جدید')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('lessons.store') }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('post')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">نام درس :</label>
                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="نام درس را وارد کنید" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">کد درس :</label>
                <input type="name" name="code" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="کد درس را وارد کنید" value="{{ old('code') }}">
                @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="group" class="form-label">گروه درس :</label>
                <input type="name" name="group" class="form-control @error('group') is-invalid @enderror" id="group" placeholder="گروه درس را وارد کنید" value="{{ old('group') }}">
                @error('group')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
