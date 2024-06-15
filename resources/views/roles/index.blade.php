@extends('layouts.app', ['pagination_items' => $roles])

@section('title', 'همه سطوح')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover rounded overflow-hidden shadow-sm">
            <thead>
            <tr>
                <th class="fw-normal text-center align-middle" scope="col">#</th>
                <th class="fw-normal text-center align-middle" scope="col">نام دسترسی</th>
                <th class="fw-normal text-center align-middle" scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $key=> $role)
                <tr>
                    <th class="fw-normal text-center align-middle" scope="row">{{ ++$key }}</th>
                    <td class="fw-normal text-center align-middle">{{ $role->name }}</td>

                    <td class="fw-normal text-center text-nowrap align-middle">
                        <a href="{{ route('lessons.edit', ['lesson' => $role->id]) }}" class="btn btn-sm btn-primary">
                            ویرایش
                        </a>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('lessons.destroy', ['lesson' => $role->id]) }}" data-bs-name="{{ $role->name }}">
                            حذف
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('layouts.modal')
@endsection
