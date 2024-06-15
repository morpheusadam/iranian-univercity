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
            font-size: {{ config('pdf.history-font-size') }};
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
    <table class="table table-bordered around-border">
        <thead>
            <tr class="around-border">
                <th class="text-center align-middle fw-normal left-border">کلاس</th>
                <th class="text-center align-middle fw-normal left-border">تشکیل شده</th>
                <th class="text-center align-middle fw-normal left-border">تشکیل نشده</th>
                <th class="text-center align-middle fw-normal left-border">کلاس خالی</th>
                <th class="text-center align-middle fw-normal left-border">مجموع تشکیل شده ها</th>
            </tr>
        </thead>

        <tbody>
            @php
                $shown_classrooms_id = [];
            @endphp

            @foreach ($classrooms as $class)
                @if (in_array($class->id, $shown_classrooms_id))
                    @continue
                @endif

                <tr class="around-border">
                    <th class="text-center left-border" >
                        {{-- <div style="display: flexbox">
                            <span>{{ $class->week_day . ' ساعت' }}</span>
                            @if (str_contains($class->time_period->period, '-'))
                                @php
                                    $array = toPersianDigits(explode('-', $class->time_period->period));
                                @endphp

                                <span>{{ $array[1] . '-' . $array[0] }}</span>
                            @else
                                <span>{{ toPersianDigits($class->time_period->period) }}</span>
                            @endif
                        </div> --}}

                        درس :
                        @if (isset($class->lesson->name))
                            {{ toPersianDigits($class->lesson->name) . ' ' }}
                            <br>
                        @else
                            - <br>
                        @endif

                        استاد :
                        @if (isset($class->professor))
                            {{ toPersianDigits($class->professor->name) . ' ' }}
                            <br>
                        @else
                            - <br>
                        @endif

                        {{-- وضعیت :
                        @if (isset($class->status))
                            {{ $class->status . ' ' }}
                            <br>
                        @else
                            - <br>
                        @endif --}}

                        گروه آموزشی :
                        @if (isset($class->educational_group))
                            {{ toPersianDigits($class->educational_group->name) . ' ' }}
                            <br>
                        @else
                            - <br>
                        @endif

                        {{-- ورودی :
                        @if (isset($class->entry))
                            {{ toPersianDigits($class->entry->year) . ' ' }}
                            <br>
                        @else
                            - <br>
                        @endif --}}
                    </th>

                    @php
                        $relations = App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->where('classroom_id', $class->id);
                        $similar_classrooms_id = App\Models\Classroom::where('lesson_id', $class->lesson_id)
                            ->where('professor_id', $class->professor_id)
                            ->where('eg_id', $class->eg_id)
                            ->pluck('id');
                    @endphp

                    <td class="text-center align-middle left-border">
                        @foreach (App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'created')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get() as $relation)
                            {{ toPersianDigits(jdate($relation->date)->format('Y-m-d')) }}
                            <br>
                        @endforeach
                    </td>

                    <td class="text-center align-middle left-border">
                        @foreach (App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'not_created')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get() as $relation)
                            {{ toPersianDigits(jdate($relation->date)->format('Y-m-d')) }}
                            <br>
                        @endforeach
                    </td>

                    <td class="text-center align-middle left-border">
                        @foreach (App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'empty')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get() as $relation)
                            {{ toPersianDigits(jdate($relation->date)->format('Y-m-d')) }}
                            <br>
                        @endforeach
                    </td>
                    <td class="text-center left-border">
                        @php
                            $created=  App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'created')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get();
                            echo $created->count();

                        @endphp
                    </td>
                </tr>

                @foreach ($similar_classrooms_id as $id)
                    @php
                        array_push($shown_classrooms_id, $id);
                    @endphp
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>

</html>
