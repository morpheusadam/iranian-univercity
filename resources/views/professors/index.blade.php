@extends('layouts.app', ['pagination_items' => $professors])

@section('title', 'همه اساتید')

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
                    <th class="fw-normal text-center align-middle" scope="col">نام استاد</th>
                    <th class="fw-normal text-center align-middle" scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($professors as $professor)
                    <tr>
                        <th class="fw-normal text-center align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-normal text-center align-middle">{{ $professor->name }}</td>
                        <td class="fw-normal text-center text-nowrap align-middle">
                            <a href="{{ route('professors.edit', ['professor' => $professor->id]) }}" class="btn btn-sm btn-primary">
                                ویرایش
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('professors.destroy', ['professor' => $professor->id]) }}" data-bs-name="{{ $professor->name }}">
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
