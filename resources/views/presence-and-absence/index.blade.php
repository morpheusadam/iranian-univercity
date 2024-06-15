@extends('layouts.app')

@section('title', 'جدول هفتگی حضور غیاب')

@section('style')
    <style>
        .selection {
            border-width: 0 !important;
        }

        .select2-selection {
            border: 0 !important;
        }
    </style>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('failed'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('failed') }}
        </div>
    @endif

    <form class="d-flex justify-content-center align-items-center mb-3" action="{{ route('p-a.index') }}" method="GET" enctype="multipart/form-data">
        @csrf
        @method('get')

        <button type="submit" class="btn btn-primary rounded-end-circle ms-1"><i class="bi bi-search"></i></button>

        <div class="d-flex align-items-center">
            <input name="day" type="number" class="form-control h-100 ms-1" style="width: 4rem" placeholder="روز" min="1" max="31" value="{{ request('day') ?? jdate(now())->getDay() }}" required>
            <input name="month" type="number" class="form-control h-100 ms-1" style="width: 4rem" placeholder="ماه" min="1" max="12" value="{{ request('month') ?? jdate(now())->getMonth() }}" required>
            <input name="year" type="number" class="form-control h-100 ms-2" style="width: 6rem" placeholder="سال" min="1350" value="{{ request('year') ?? jdate(now())->getYear() }}" required>
        </div>
    </form>

    <div class="table-responsive text-center">
        <table class="table table-bordered border-secondary rounded shadow-sm" style="font-size: 12px">
            <thead>
                <tr>
                    <th class="text-center align-middle fw-normal border-bottom-0" style="width: min-content ">روز<br>هفته</th>
                    <th class="p-0 border-bottom-0" colspan="{{ $locations->count() + 1 }}">
                        <table class="table w-100 mb-0">
                            <thead>
                                <tr style="display: grid; grid-template-columns: {{ str_repeat('1fr ', $locations->count() + 1) }}">
                                    <th class="text-center align-middle fw-normal">ساعت<br>کلاس</th>

                                    @foreach ($locations as $location)
                                        <th class="text-center align-middle fw-normal">کلاس<br>{{ $location->number }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </th>
                </tr>
            </thead>

            <form action="{{ route('p-a.determine') }}" method="POST" enctype="multipart/form-data" id="p-a-form">
                @csrf
                @method('post')

                <tbody>
                    @php
                        $week_days = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'];
                    @endphp

                    @foreach ($week_days as $day)
                        <tr>
                            @php
                                $rowMiladiDate = jdate($startOfWeek)
                                    ->addDays($loop->index)
                                    ->toCarbon()
                                    ->format('Y-m-d');
                            @endphp

                            <th class="text-center align-middle fw-normal text-nowrap" style="writing-mode: vertical-rl;" scope="row">
                                {{ $day }}
                                <br>
                                {{ $rowShamsiDate = jdate($startOfWeek)->addDays($loop->index)->format('Y-m-d') }}
                            </th>

                            <td class="p-0 table-responsive" colspan="{{ $locations->count() + 1 }}">
                                <table class="table align-middle m-0">
                                    <tbody>
                                        @foreach ($time_periods as $time)
                                            <tr cl style="display: grid; grid-template-columns: {{ str_repeat('1fr ', $locations->count() + 1) }}">
                                                <th class="d-flex align-items-center justify-content-center align-middle fw-normal text-nowrap">{{ $time->period }}</th>

                                                @foreach ($locations as $location)
                                                    @php
                                                        $classes = $classrooms
                                                            ->whereIn(
                                                                'id',
                                                                DB::table('classroom_location_term')
                                                                    ->where('location_id', $location->id)
                                                                    ->where('term_id', session('current_term_id'))
                                                                    ->pluck('classroom_id'),
                                                            )
                                                            ->where('week_day', $day)
                                                            ->where('time_period_id', $time->id);
                                                    @endphp

                                                    <td class="text-center px-0 fw-normal @if ($classes->count() == 1) d-flex flex-column justify-content-center align-items-center @endif">
                                                        @foreach ($classes as $class)
                                                            <div>
                                                                درس :
                                                                @if (isset($class->lesson->name))
                                                                    {{ $class->lesson->name . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif

                                                                استاد :
                                                                @if (isset($class->professor))
                                                                    {{ $class->professor->name . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            </div>

                                                            @php
                                                                $relation = App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))
                                                                    ->where('classroom_id', $class->id)
                                                                    ->where('date', $rowMiladiDate)
                                                                    ->first();

                                                                $class_status = !is_null($relation) ? $relation->status : null;
                                                            @endphp

                                                            <select name="status[{{ $class->id . '.' . $rowMiladiDate }}]" class="form-select form-select-sm mySelect2 rounded-0 js-example-basic-single text-center my-2 mx-auto w-75">
                                                                <option></option>
                                                                <option value="created" @selected($class_status == 'created')>تشکیل شده</option>
                                                                <option value="not_created" @selected($class_status == 'not_created')>تشکیل نشده</option>
                                                                <option value="empty" @selected($class_status == 'empty')>خالی</option>
                                                            </select>

                                                            @if (!$loop->last)
                                                                <hr>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </form>

        </table>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example" dir="ltr">
            <button type="button" class="btn btn-warning text-white" onclick="$('.mySelect2').val(null).trigger('change')">پاک کردن</button>
            <button type="button" class="btn btn-success" onclick="document.getElementById('p-a-form').submit()">ثبت</button>
        </div>
    </div>
@endsection
