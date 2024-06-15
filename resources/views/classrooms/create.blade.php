@extends('layouts.app')

@section('title', 'تعریف کلاس جدید')

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

    <div class="table-responsive text-center">
        <table class="table table-bordered border-secondary rounded shadow-sm h-100">
            <thead> 
                <tr>
                    <th class="fw-normal text-center align-middle" scope="col">#</th>
                    @foreach ($time_periods as $time)
                        <th class="fw-normal text-center align-middle">{{ $time->period }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $week_days = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'];
                @endphp

                <form id="form" action="{{ route('classrooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @foreach ($week_days as $week_day_key => $day)
                        <tr>
                            <th class="fw-normal text-center align-middle text-nowrap" scope="row">{{ $day }}</th>
                            @foreach ($time_periods as $time)
                                <td class="fw-normal text-center align-middle p-0">

                                    <select name="lesson_id[{{ $week_day_key . '-' . $time->id }}]" class="form-select form-select-sm mySelect2 rounded-0 border-0 js-example-basic-single">
                                        <option selected disabled></option>

                                        @foreach (\App\Models\lesson::latest()->get() as $lesson)
                                            <option value="{{ $lesson->id }}" {{ old('lesson_id') == $lesson->id ? 'selected' : ' ' }}>{{ $lesson->name }}</option>
                                        @endforeach
                                    </select>

                                    <select name="professor_id[{{ $week_day_key . '-' . $time->id }}]" class="form-select form-select-sm mySelect2 rounded-0 border-0 js-example-basic-single">
                                        <option selected disabled></option>

                                        @foreach (\App\Models\Professor::latest()->get() as $professor)
                                            <option value="{{ $professor->id }}" {{ old('professor_id') == $professor->id ? 'selected' : ' ' }}>{{ $professor->name }}</option>
                                        @endforeach
                                    </select>

                                    <select name="status[{{ $week_day_key . '-' . $time->id }}]" class="form-select form-select-sm mySelect2 rounded-0 border-0 js-example-basic-single">
                                        <option selected disabled></option>
                                        <option value="ثابت" {{ old('status') == 'ثابت' ? 'selected' : ' ' }}>ثابت</option>
                                        <option value="چرخشی" {{ old('status') == 'چرخشی' ? 'selected' : ' ' }}>چرخشی</option>
                                    </select>

                                    <select name="eg_id[{{ $week_day_key . '-' . $time->id }}]" class="form-select form-select-sm mySelect2 rounded-0 border-0 js-example-basic-single">
                                        <option selected disabled></option>

                                        @foreach (\App\Models\EducationalGroup::latest()->get() as $educational_group)
                                            <option value="{{ $educational_group->id }}" {{ old('eg_id') == $educational_group->id ? 'selected' : ' ' }}>{{ $educational_group->name }}</option>
                                        @endforeach
                                    </select>

                                    <select name="entry_id[{{ $week_day_key . '-' . $time->id }}]" class="form-select form-select-sm mySelect2 rounded-0 border-0 js-example-basic-single">
                                        <option selected disabled></option>

                                        @foreach (DB::table('entries')->orderBy('year')->get() as $entry)
                                            <option value="{{ $entry->id }}" {{ old('entry_id') == $entry->id ? 'selected' : ' ' }}>{{ $entry->year }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example" dir="ltr">
            <button type="button" class="btn btn-warning text-white" onclick="$('.mySelect2').val(null).trigger('change')">پاک کردن</button>
            <button type="button" class="btn btn-success" onclick="document.getElementById('form').submit()">ثبت</button>
        </div>
    </div>
@endsection
