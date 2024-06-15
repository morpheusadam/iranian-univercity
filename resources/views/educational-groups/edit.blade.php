@extends('layouts.app')

@section('title', 'ویرایش گروه آموزشی')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        <form action="{{ route('educational-groups.update', ['educational_group' => $educational_group->id]) }}" method="POST" class="col-lg-5 card p-5 shadow-sm">
            @csrf
            @method('put')

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">نام گروه آموزشی :</label>
                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="نام گروه را وارد کنید" value="{{ old('name') ?? $educational_group->name}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="initials" class="form-label">حروف اختصاری :</label>
                <input type="name" name="initials" class="form-control @error('initials') is-invalid @enderror" id="initials" placeholder="گروه درس را وارد کنید" value="{{ old('initials') ?? $educational_group->initials }}">
                @error('initials')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @else
                    <div class="form-text">حروف مختصر در جدول نمایش داده خواهند شد.</div>
                    <div class="form-text">برای مثال (گروه کامپیوتر : گ ک)</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        </form>
    </div>
@endsection
