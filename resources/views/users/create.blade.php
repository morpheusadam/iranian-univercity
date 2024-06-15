@extends('layouts.app')

@section('title', 'ایجاد کاربر جدید')

@section('content')
    <div class="alert alert-info" role="alert">
        رمز عبور به طور پیش فرض 12345678 است.
    </div>
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('users.store') }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('post')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">نام و نام خانوادگی :</label>
                <input name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">نام کاربری :</label>
                <input name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="نام کاربری را وارد کنید" value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

           <input type="hidden" name="password" value="{{\Illuminate\Support\Facades\Hash::make("12345678")}}">
            <div class="mb-3">
                <label for="name" class="form-label">سطح کاربری :</label>
                <select class="form-select" aria-label="Default select example" name="role">
                    <option selected>انتخاب کنید</option>
                    <option value="1">مسئول آموزش کل</option>
                    <option value="2">رئیس دانشکده</option>
                    <option value="3">مدیر گروه</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">دانشکده :</label>
                <select class="form-select" aria-label="Default select example" name="collages_id">
                    <option selected>انتخاب کنید</option>

                    @foreach($collages as $collage)

                        <option value="{{$collage->id}}">{{$collage->name}}</option>
                    @endforeach


                </select>
                @error('collages_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
