@extends('layouts.app')

@section('title', 'ایجاد سطح دسترسی جدید')

@section('content')
    <div class="row justify-content-center align-items-center h-100 p-5">
        {!! Form::open(array('route' => 'roles.store','method'=>'POST','class'=>'col-lg-5 card p-5 shadow-sm')) !!}

            @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">نام سطح دسترسی :</label>
                {!! Form::text('name', null, array('placeholder' => 'نام سطح دسترسی را وارد کنید','class' => 'form-control')) !!}
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-check">
                <label for="code" class="form-label">دسترسی ها :</label>
                    <br>
                @foreach($permission as $value)
                    <label class="form-check-label ">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input text-center')) }}
                        <p class="mx-4">
                            {{ $value->name_fa }}
                        </p>

                    </label>
                    <br/>
                @endforeach
                </div>
                @error('permission')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-info text-white">ذخیره</button>
        {!! Form::close() !!}
    </div>
@endsection
