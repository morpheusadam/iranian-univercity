<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پیش نمایش PDF | برنامه آموزشی دانشگاه</title>

    <style type="text/css" media="all">
        @page {
            header: page-header;
            footer: page-footer;
        }

        body {
            font-family: 'Shabnam';
            font-size: {{ config('pdf.shedule-font-size') }};
        }

        th {
            font-weight: normal;
        }

        .around-border {
            border-style: solid;
            border-width: thin;
        }

        .top-border {
            border-top-style: solid;
            border-top-width: thin;
        }

        .bottom-border {
            border-bottom-style: solid;
            border-bottom-width: thin;
        }

        .right-border {
            border-right-style: solid;
            border-right-width: thin;
        }

        .left-border {
            border-left-style: solid;
            border-left-width: thin;
        }

        tr {
            display: inline;
        }
    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr class="around-border">
                <th class="around-border text-center align-middle">روز<br>هفته</th>
                <th class="around-border p-0" colspan="{{ $locations->count() + 1 }}">
                    <table class="w-100 mb-0">
                        <thead>
                            <tr class="right-border">
                                @php
                                    $cell_width = intval(100/($locations->count()+1));
                                @endphp

                                <th class="text-center align-middle fw-normal">ساعت<br>کلاس</th>

                                @foreach ($locations as $location)
                                    <th class="text-center align-middle fw-normal right-border" style="width: {{ $cell_width }}%">کلاس<br>{{ toPersianDigits($location->number) }}</th>
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
                <tr class="around-border">
                    <th class="around-border text-center align-middle fw-normal" id="second" scope="row">{{ $day }}</th>

                    <td class="around-border p-0 table-responsive" colspan="{{ $locations->count() + 1 }}">
                        <table class="w-100 m-0">
                            <tbody>
                                @foreach ($time_periods as $time)
                                    <tr class="w-100 right-border @if (!$loop->last) bottom-border @endif">
                                        <th class="d-flex align-items-center text-center align-middle fw-normal text-nowrap">{{ toPersianDigits($time->period) }}</th>

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

                                            <td class="right-border text-center align-middle fw-normal" style="width: {{ $cell_width }}%">
                                                @foreach ($classes as $class)
                                                    @if (request('show_lesson_group') && isset($class->lesson->group))
                                                        {{ toPersianDigits($class->lesson->group) . ' ' }}
                                                        <br>
                                                    @endif

                                                    @if (request('show_lesson_name') && isset($class->lesson->name))
                                                        {{ toPersianDigits($class->lesson->name) . ' ' }}
                                                        <br>
                                                    @endif

                                                    @if (request('show_professor_name') && isset($class->professor))
                                                        {{ toPersianDigits($class->professor->name) . ' ' }}
                                                        <br>
                                                    @endif

                                                    @if (request('show_status') && isset($class->status))
                                                        {{ $class->status . ' ' }}
                                                        <br>
                                                    @endif

                                                    @if (request('show_eg_name') && isset($class->educational_group))
                                                        {{ toPersianDigits($class->educational_group->name) . ' ' }}
                                                        <br>
                                                    @endif

                                                    @if (request('show_entry_year') && isset($class->entry))
                                                        {{ toPersianDigits($class->entry->year) . ' ' }}
                                                        <br>
                                                    @endif

                                                    @if (!$loop->last)
                                                        <hr class="my-1">
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

    <htmlpagefooter name="page-footer">
        <hr>
        @foreach ($classrooms as $class)
            @if (!is_null($class->educational_group))
                <span>{{ !$loop->first ? '  |  ' : '' }}{{ toPersianDigits($class->educational_group->initials) . ':' . toPersianDigits($class->educational_group->name) }}</span>
            @endif
        @endforeach
    </htmlpagefooter>
</body>

</html>
