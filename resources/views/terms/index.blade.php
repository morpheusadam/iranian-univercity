@extends('layouts.app', ['pagination_items' => $terms])

@section('title', 'همه ورودی ها')

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
                    <th class="fw-normal text-center align-middle" scope="col">شماره ترم</th>
                    <th class="fw-normal text-center align-middle" scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terms as $term)
                    <tr>
                        <th class="fw-normal text-center align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-normal text-center align-middle">{{ $term->number }}</td>
                        <td class="fw-normal text-center text-nowrap align-middle">
                            <a href="{{ route('terms.edit', ['term' => $term->id]) }}" class="btn btn-sm btn-primary">
                                ویرایش
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('terms.destroy', ['term' => $term->id]) }}" data-bs-name="{{ $term->number }}">
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
