@extends('layouts.app')

@section('title', 'تعیین مکان کلاس ها')

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

            const manually_select = document.getElementById('manually-select');

            const classes = document.getElementById('classes')
            const professors = document.getElementById('professors')
            const educational_groups = document.getElementById('educational_groups')
            const entries = document.getElementById('entries')
            const status = document.getElementById('status')

            manually_select.addEventListener("click", () => {
                classes.toggleAttribute("disabled");
                professors.toggleAttribute("disabled");
                educational_groups.toggleAttribute("disabled");
                entries.toggleAttribute("disabled");
                status.toggleAttribute("disabled");
            })
        });
    </script>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning text-center" role="alert">
            {{ session('warning') }}
        </div>
    @endif

    <div class="table-responsive text-center">
        <table class="table table-bordered border-secondary rounded shadow-sm h-100">
            <thead>
                <tr>
                    <th></th>
                    @foreach ($time_periods as $time)
                        <th class="text-center align-middle fw-normal">{{ $time->period }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @php
                    $week_days = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'];
                @endphp

                <form id="locations-form" action="{{ route('locations.set') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @foreach ($week_days as $week_day_key => $day)
                        <tr>
                            <th class="text-center align-middle fw-normal text-nowrap" scope="row">{{ $day }}</th>

                            @foreach ($time_periods as $time)
                                <td class="fw-normal text-center align-middle px-0">
                                    @foreach ($td_classrooms = $classrooms->where('week_day', $day)->where('time_period_id', $time->id) as $class)
                                        @if ($show_lesson_group && !is_null($class->lesson))
                                            {{ $class->lesson->group }}
                                            <br>
                                        @endif

                                        @if ($show_lesson_name && !is_null($class->lesson))
                                            {{ $class->lesson->name }}
                                            <br>
                                        @endif

                                        @if ($show_professor_name && !is_null($class->professor))
                                            {{ $class->professor->name }}
                                            <br>
                                        @endif

                                        @if ($show_status && !is_null($class->status))
                                            {{ $class->status }}
                                            <br>
                                        @endif

                                        @if ($show_entry_year && !is_null($class->entry))
                                            @if ($show_eg_name && !is_null($class->educational_group))
                                                (
                                            @endif

                                            {{ $class->entry->year }}

                                            @if (is_null($class->educational_group))
                                                <br>
                                            @endif
                                        @endif

                                        @if ($show_eg_name && !is_null($class->educational_group))
                                            {{ $class->educational_group->name }}

                                            @if ($show_entry_year && !is_null($class->entry))
                                                )
                                            @endif

                                            <br>
                                        @endif

                                        @php
                                            $relation = DB::table('classroom_location_term')
                                                ->where('term_id', session('current_term_id'))
                                                ->where('classroom_id', $class->id)
                                                ->first();

                                            $class_location_id = $relation ? $relation->location_id : null;
                                        @endphp

                                        <select name="location_id[{{ $class->id }}]" class="form-select form-select-sm mySelect2 rounded-0 js-example-basic-single text-center fs-6 my-2 mx-auto w-75">
                                            <option selected></option>
                                            @foreach (\App\Models\Location::orderBy('number')->get() as $location)
                                                <option value="{{ $location->id }}" @selected($class_location_id == $location->id)>{{ $location->number }}</option>
                                            @endforeach
                                        </select>

                                        @if (($show_lesson_group || $show_lesson_name || $show_professor_name || $show_status || $show_entry_year || $show_eg_name) && !$loop->last)
                                            <hr @if ($td_classrooms->count() == 2) style="margin:8px 0" @else style="margin:2px 0" @endif>
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example" dir="ltr">
            <button type="button" class="btn btn-warning text-white" onclick="$('.mySelect2').val(null).trigger('change')">پاک کردن</button>
            <button type="button" class="btn btn-success" onclick="document.getElementById('locations-form').submit()">ثبت</button>
        </div>
    </div>

    @include('layouts.modal')
@endsection
