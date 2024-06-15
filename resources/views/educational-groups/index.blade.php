@extends('layouts.app', ['pagination_items' => $educational_groups])

@section('title', 'همه گروه های آموزشی')

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
                    <th class="fw-normal text-center align-middle" scope="col">نام گروه</th>
                    <th class="fw-normal text-center align-middle" scope="col">حروف اختصاری</th>
                    <th class="fw-normal text-center align-middle" scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($educational_groups as $educational_group)
                    <tr>
                        <th class="fw-normal text-center align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-normal text-center align-middle">{{ $educational_group->name }}</td>
                        <td class="fw-normal text-center align-middle">({{ $educational_group->initials }})</td>
                        <td class="fw-normal text-center text-nowrap align-middle">
                            <a href="{{ route('educational-groups.edit', ['educational_group' => $educational_group->id]) }}" class="btn btn-sm btn-primary">
                                ویرایش
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('educational-groups.destroy', ['educational_group' => $educational_group->id]) }}" data-bs-name="{{ $educational_group->name }}">
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
