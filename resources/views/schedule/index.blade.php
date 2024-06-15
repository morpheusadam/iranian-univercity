@extends('layouts.app')

@section('title', 'گزارش گیری')

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

            const Form = document.getElementById('schedule-form');
            const SaveButton = document.getElementById('save-button');
            const PreviewButton = document.getElementById('preview-button');
            const DownloadButton = document.getElementById('download-button');

            const manually_select = document.getElementById('manually-select');

            const classes = document.getElementById('classes')
            const professors = document.getElementById('professors')
            const educational_groups = document.getElementById('educational_groups')
            const entries = document.getElementById('entries')
            const status = document.getElementById('status')

            SaveButton.addEventListener("click", () => {
                Form.action = "{{ route('schedule.filter') }}"
                Form.method = 'POST'
                Form.submit()
            })

            PreviewButton.addEventListener("click", () => {
                Form.action = "{{ route('schedule.preview') }}"
                Form.method = 'GET'
                Form.submit()
            })

            DownloadButton.addEventListener("click", () => {
                Form.action = "{{ route('schedule.download') }}"
                Form.method = 'GET'
                Form.submit()
            })

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

    <form id="schedule-form" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-4" action="{{ route('classrooms.filter') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="col">
            <label for="classes" class="form-label">همه کلاس ها :</label>
            <select name="classes[]" class="js-example-basic-multiple text-center" id="classes" multiple @disabled(!request('manually_select'))>
                <option disabled>کلاس ها را انتخاب کنید</option>

                @foreach (App\Models\ClassRoom::latest()->get() as $class)
                    <option value="{{ $class->id }}" @selected(request()->has('classes') && in_array($class->id, request('classes')))>
                        {{ (!is_null($class->lesson) ? $class->lesson->name : null) . ' ' . (!is_null($class->professor) ? $class->professor->name : null) . ' (' . $class->week_day }}
                    </option>
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

        <div class="col">
            <button id="save-button" type="button" class="btn btn-success w-100 mt-4">اعمال <i class="bi bi-check-lg"></i></button>
        </div>

        <div class="col">
            <button id="preview-button" type="button" class="btn btn-primary w-100 mt-4">پیش نمایش <i class="bi bi-eye"></i></button>
        </div>

        <div class="col">
            <a class="btn btn-warning text-white w-100 mt-4" href="{{route('schedule.download.word')}}">دانلود word <i class="bi bi-download"></i></a>
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

            <tbody>
                @php
                    $week_days = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه'];
                @endphp

                @foreach ($week_days as $day)
                    <tr>
                        {{-- style="writing-mode: vertical-rl;"  --}}
                        <th class="text-center align-middle fw-normal text-nowrap" style="writing-mode: vertical-rl;" scope="row">{{ $day }}</th>

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

                                                <td class="text-center px-0 fw-normal">
                                                    @foreach ($classes as $class)
                                                        <div class="px-1">
                                                            @if ($show_lesson_group)
                                                                گروه درس :
                                                                @if (isset($class->lesson->group))
                                                                    {{ $class->lesson->group . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            @endif

                                                            @if ($show_lesson_name)
                                                                درس :
                                                                @if (isset($class->lesson->name))
                                                                    {{ $class->lesson->name . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            @endif

                                                            @if ($show_professor_name)
                                                                استاد :
                                                                @if (isset($class->professor))
                                                                    {{ $class->professor->name . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            @endif

                                                            @if ($show_status)
                                                                وضعیت :
                                                                @if (isset($class->status))
                                                                    {{ $class->status . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            @endif

                                                            @if ($show_eg_name)
                                                                گروه آموزشی :
                                                                @if (isset($class->educational_group))
                                                                    {{ $class->educational_group->name . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            @endif

                                                            @if ($show_entry_year)
                                                                ورودی :
                                                                @if (isset($class->entry))
                                                                    {{ $class->entry->year . ' ' }}
                                                                    <br>
                                                                @else
                                                                    - <br>
                                                                @endif
                                                            @endif
                                                        </div>

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
        </table>
    </div>
@endsection
