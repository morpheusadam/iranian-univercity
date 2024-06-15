@extends('layouts.app')

@section('title', 'ویرایش مکان برگزاری')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('locations.update', ['location' => $location->id]) }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('put')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="number" class="form-label">مکان برگزاری (شماره کلاس) :</label>
                <input type="name" name="number" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="شماره کلاس را وارد کنید" value="{{ old('number') ?? $location->number }}">
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
