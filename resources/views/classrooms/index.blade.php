@extends('layouts.app')

@section('title', 'جدول کلاس ها')

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
    @elseif (session('failed'))
        <div class="alert alert-danger text-center" role="alert">
            {{ session('failed') }}
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            در صورتی که قصد اعمال همه ی کلاس ها را دارید تمام لیست ها را خالی بگذارید.
            <br>
            برای انتخاب چندتایی در هر لیست دکمه "ctrl" کیبورد را نگه داشته و با موس اقدام به انتخاب نمایید.
            <br>
            درصورت وجود نداشتن درس, استاد و ... مدنظر در لیست های زیر به معنای عدم <a class="link-primary" href="{{ route('classrooms.create') }}"> تعریف کلاس</a> برای آنهاست.
        </div>
    @endif

    <form class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-4" action="{{ route('classrooms.filter') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="col">
            <label for="classes" class="form-label">همه کلاس ها :</label>
            <select name="classes[]" class="js-example-basic-multiple text-center" id="classes" multiple @disabled(!request('manually_select'))>
                <option disabled>کلاس ها را انتخاب کنید</option>

                @foreach (App\Models\ClassRoom::latest()->get() as $class)
                    <option value="{{ $class->id }}" @selected(request()->has('classes') && in_array($class->id, request('classes')))>{{ (!is_null($class->lesson) ? $class->lesson->name : null) . ' ' . (!is_null($class->professor) ? $class->professor->name : null) . ' (' . $class->week_day . ' ' . $class->time_period->period . ')' }}</option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="professors" class="form-label">کلاس های اساتید :</label>
            <select name="professors[]" class="js-example-basic-multiple text-center" id="professors" multiple @disabled(request('manually_select'))>
                <option disabled>اساتید را انتخاب کنید</option>

                @foreach (App\Models\ClassRoom::select('professor_id')->distinct()->get() as $class)
                    @if ($class->professor)
                        <option value="{{ $class->professor->id }}" @selected(request()->has('professors') && in_array($class->professor->id, request('professors')))>{{ $class->professor->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="educational_groups" class="form-label">کلاس های گروه های آموزشی :</label>
            <select name="educational_groups[]" class="js-example-basic-multiple text-center" id="educational_groups" multiple @disabled(request('manually_select'))>
                <option disabled>گروه ها را انتخاب کنید</option>

                @foreach (App\Models\ClassRoom::select('eg_id')->distinct()->get() as $class)
                    @if ($class->educational_group)
                        <option value="{{ $class->educational_group->id }}" @selected(request()->has('educational_groups') && in_array($class->educational_group->id, request('educational_groups')))>{{ $class->educational_group->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="entries" class="form-label">کلاس های ورودی ها :</label>
            <select name="entries[]" class="js-example-basic-multiple text-center" id="entries" multiple @disabled(request('manually_select'))>
                <option disabled>کلاس ها را انتخاب کنید</option>

                @foreach (App\Models\ClassRoom::select('entry_id')->distinct()->get() as $class)
                    @if ($class->entry)
                        <option value="{{ $class->entry->id }}" @selected(request()->has('entries') && in_array($class->entry->id, request('entries')))>{{ $class->entry->year }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="status" class="form-label">وضعیت کلاس ها:</label>
            <select name="status" class="form-select text-center" id="status" @disabled(request('manually_select'))>
                <option value="" selected>وضعیت را انتخاب کنید</option>
                <option value="ثابت" @selected(request()->has('status') && request('status') == 'ثابت')>ثابت</option>
                <option value="چرخشی" @selected(request()->has('status') && request('status') == 'چرخشی')>چرخشی</option>
            </select>

            <div class="form-check form-switch mt-4">
                <input name="manually_select" value="true" class="form-check-input" type="checkbox" role="switch" id="manually-select" @checked(request('manually_select'))>
                <label class="form-check-label" style="margin-right: 40px" id="manually-select-label">انتخاب دستی کلاس ها</label>
            </div>
        </div>

        <div class="col row row-cols-2 text-nowrap user-select-none mt-3" style="font-size: 0.8rem !important">
            <div class="col">
                <div class="form-check">
                    <input name="show_lesson_group" id="show_lesson_group" class="form-check-input" type="checkbox" value="true" @checked($show_lesson_group)>
                    <label class="form-check-label" style="margin-right: 25px" for="show_lesson_group">
                        نمایش گروه درس
                    </label>
                </div>

                <div class="form-check">
                    <input name="show_lesson_name" id="show_lesson_name" class="form-check-input" type="checkbox" value="true" @checked($show_lesson_name)>
                    <label class="form-check-label" style="margin-right: 25px" for="show_lesson_name">
                        نمایش نام درس
                    </label>
                </div>

                <div class="form-check">
                    <input name="show_professor_name" id="show_professor_name" class="form-check-input" type="checkbox" value="true" @checked($show_professor_name)>
                    <label class="form-check-label" style="margin-right: 25px" for="show_professor_name">
                        نمایش نام استاد
                    </label>
                </div>
            </div>

            <div class="col">
                <div class="form-check">
                    <input name="show_status" id="show_status" class="form-check-input" type="checkbox" value="true" @checked($show_status)>
                    <label class="form-check-label" style="margin-right: 25px" for="show_status">
                        نمایش وضعیت
                    </label>
                </div>

                <div class="form-check">
                    <input name="show_entry_year" id="show_entry_year" class="form-check-input" type="checkbox" value="true" @checked($show_entry_year)>
                    <label class="form-check-label" style="margin-right: 25px" for="show_entry_year">
                        نمایش ورودی
                    </label>
                </div>

                <div class="form-check">
                    <input name="show_eg_name" id="show_eg_name" class="form-check-input" type="checkbox" value="true" @checked($show_eg_name)>
                    <label class="form-check-label" style="margin-right: 25px" for="show_eg_name">
                        نمایش گروه آموزشی
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mx-auto mt-4">اعمال<i class="bi bi-check-lg"></i></button>
    </form>

    <div class="table-responsive text-center">
        <table class="table table-bordered border-secondary rounded shadow-sm h-100">
            <thead>
                <tr>
                    <th class="fw-normal text-center align-middle" scope="col">#</th>
                    @foreach ($time_periods as $time)
                        <th class="text-center align-middle fw-normal">{{ $time->period }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @php
                    $week_days = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'];
                @endphp

                <form id="classes-form" action="{{ route('classrooms.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @foreach ($week_days as $day)
                        <tr>
                            <th class="text-center align-middle fw-normal text-nowrap" scope="row">{{ $day }}</th>

                            @foreach ($time_periods as $time)
                                <td class="fw-normal text-center align-middle px-0">
                                    @foreach ($td_classrooms = $classrooms->where('week_day', $day)->where('time_period_id', $time->id) as $class)
                                        @if ($show_lesson_name)
                                            <select name="lesson_id[{{ $class->id }}]" class="form-select form-select-sm text-center fs-6 mySelect2 rounded-0 border-0 js-example-basic-single">
                                                <option selected></option>

                                                @foreach (\App\Models\lesson::latest()->get() as $lesson)
                                                    <option value="{{ $lesson->id }}" @selected(!is_null($class->lesson) && $class->lesson->id == $lesson->id)>{{ $lesson->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($show_professor_name)
                                            <select name="professor_id[{{ $class->id }}]" class="form-select form-select-sm text-center fs-6 mySelect2 rounded-0 border-0 js-example-basic-single">
                                                <option selected></option>

                                                @foreach (\App\Models\Professor::latest()->get() as $professor)
                                                    <option value="{{ $professor->id }}" @selected(!is_null($class->professor) && $class->professor->id == $professor->id)>{{ $professor->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($show_status)
                                            <select name="status[{{ $class->id }}]" class="form-select form-select-sm text-center fs-6 mySelect2 rounded-0 border-0 js-example-basic-single">
                                                <option selected></option>

                                                <option value="ثابت" @selected(!is_null($class->status) && $class->status == 'ثابت')>ثابت</option>
                                                <option value="چرخشی" @selected(!is_null($class->status) && $class->status == 'چرخشی')>چرخشی</option>
                                            </select>
                                        @endif

                                        @if ($show_eg_name)
                                            <select name="eg_id[{{ $class->id }}]" class="form-select form-select-sm text-center fs-6 mySelect2 rounded-0 border-0 js-example-basic-single">
                                                <option selected></option>

                                                @foreach (\App\Models\EducationalGroup::latest()->get() as $educational_group)
                                                    <option value="{{ $educational_group->id }}" @selected(!is_null($class->educational_group) && $class->educational_group->id == $educational_group->id)>{{ $educational_group->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($show_entry_year)
                                            <select name="entry_id[{{ $class->id }}]" class="form-select form-select-sm text-center fs-6 mySelect2 rounded-0 border-0 js-example-basic-single">
                                                <option selected></option>

                                                @foreach (DB::table('entries')->orderBy('year')->get() as $entry)
                                                    <option value="{{ $entry->id }}" @selected(!is_null($class->entry) && $class->entry->id == $entry->id)>{{ $entry->year }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($show_lesson_group || $show_lesson_name || $show_professor_name || $show_status || $show_entry_year || $show_eg_name)
                                            <div class="btn-group mt-2" dir="ltr">
                                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-action="{{ route('classrooms.destroy', ['classroom' => $class->id]) }}" data-bs-name="{{ ($class->lesson->name ?? null) . ' ' . ($class->professor->name ?? null) . ' (' . ($class->week_day ?? null) . ' ' . $class->time_period->period . ')' }}">
                                                    حذف
                                                </button>
                                            </div>

                                            @if (!$loop->last)
                                                <hr @if ($td_classrooms->count() == 2) style="margin:8px 0" @else style="margin:2px 0" @endif>
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" onclick="document.getElementById('classes-form').submit()">ویرایش</button>
    </div>

    @include('layouts.modal')
@endsection
