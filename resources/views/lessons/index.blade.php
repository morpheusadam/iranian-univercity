@extends('layouts.app', ['pagination_items' => $lessons])

@section('title', 'همه دروس')

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
                    <th class="fw-normal text-center align-middle" scope="col">نام درس</th>
                    <th class="fw-normal text-center align-middle" scope="col">کد</th>
                    <th class="fw-normal text-center align-middle" scope="col">گروه</th>
                    <th class="fw-normal text-center align-middle" scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                    <tr>
                        <th class="fw-normal text-center align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-normal text-center align-middle">{{ $lesson->name }}</td>
                        <td class="fw-normal text-center align-middle">{{ $lesson->code ?? '-' }}</td>
                        <td class="fw-normal text-center align-middle">{{ $lesson->group ?? '-' }}</td>
                        <td class="fw-normal text-center text-nowrap align-middle">
                            <a href="{{ route('lessons.edit', ['lesson' => $lesson->id]) }}" class="btn btn-sm btn-primary">
                                ویرایش
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('lessons.destroy', ['lesson' => $lesson->id]) }}" data-bs-name="{{ $lesson->name }}">
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
