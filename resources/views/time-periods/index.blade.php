@extends('layouts.app', ['pagination_items' => $time_periods])

@section('title', 'زمان بندی')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            زمان ها در برنامه زمانی (خروجیPDF) به ترتیب زیر خواهند بود. ترتیب در این بخش رعایت شود.
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover rounded overflow-hidden shadow-sm">
            <thead>
                <tr>
                    <th class="fw-normal text-center align-middle" scope="col">#</th>
                    <th class="fw-normal text-center align-middle" scope="col">بازه زمانی</th>
                    <th class="fw-normal text-center align-middle" scope="col">عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($time_periods as $time_period)
                    <tr>
                        <th class="fw-normal text-center align-middle" scope="row">{{ $loop->iteration }}</th>
                        <td class="fw-normal text-center align-middle">{{ $time_period->period }}</td>
                        <td class="fw-normal text-center text-nowrap align-middle">
                            <a href="{{ route('time-periods.edit', ['time_period' => $time_period->id]) }}" class="btn btn-sm btn-primary">
                                ویرایش
                            </a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('time-periods.destroy', ['time_period' => $time_period->id]) }}" data-bs-name="{{ $time_period->period }}">
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
