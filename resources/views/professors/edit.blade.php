@extends('layouts.app')

@section('title', 'ویرایش اطلاعات استاد')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('professors.update', ['professor' => $professor->id]) }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('put')
  
            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">نام استاد :</label>
                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="نام استاد را وارد کنید" value="{{ old('name') ?? $professor->name}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
