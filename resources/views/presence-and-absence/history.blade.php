@extends('layouts.app')

@section('title', 'گزارش گیری تاریخچه')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('p-a.history.preview') }}" type="button" class="btn btn-primary w-100">پیش نمایش <i class="bi bi-eye"></i></a>
        </div>

        <div class="col">
            <a href="{{ route('p-a.history.download') }}" type="button" class="btn btn-warning text-white w-100">دانلود PDF <i class="bi bi-download"></i></a>
        </div>
    </div>

    <div class="table-responsive text-center">
        <table class="table table-bordered border-secondary rounded shadow-sm h-100">
            <thead>
                <tr>
                    <th class="text-center align-middle fw-normal">کلاس</th>
                    <th class="text-center align-middle fw-normal text-success"><i class="bi bi-check-circle"></i> تشکیل شده</th>
                    <th class="text-center align-middle fw-normal text-danger"><i class="bi bi-x-circle"></i> تشکیل نشده</th>
                    <th class="text-center align-middle fw-normal text-warning"><i class="bi bi-slash-circle"></i> کلاس خالی</th>
                    <th class="text-center align-middle fw-normal text-info"><i class="bi bi-check-circle"></i> مجموع تشکیل شده ها</th>
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

                    <tr>
                        <th class="text-center align-middle fw-normal text-nowrap" scope="row">
                            {{-- <div class="d-inline-flex badge bg-info fw-normal fs-6">
                                <span class="ms-1">{{ $class->week_day . ' ساعت'}}</span>
                                <span>{{ $class->time_period->period }}</span>
                            </div>
                            <br> --}}

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

                            {{-- وضعیت :
                            @if (isset($class->status))
                                {{ $class->status . ' ' }}
                                <br>
                            @else
                                - <br>
                            @endif --}}

                            گروه آموزشی :
                            @if (isset($class->educational_group))
                                {{ $class->educational_group->name . ' ' }}
                                <br>
                            @else
                                - <br>
                            @endif

                            {{-- ورودی :
                            @if (isset($class->entry))
                                {{ $class->entry->year . ' ' }}
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

                        <td class="text-center align-middle">
                            @foreach (App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'created')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get() as $relation)
                                {{ jdate($relation->date)->format('Y-m-d') }}
                                <br>
                            @endforeach
                        </td>

                        <td class="text-center align-middle">
                            @foreach (App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'not_created')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get() as $relation)
                                {{ jdate($relation->date)->format('Y-m-d') }}
                                <br>
                            @endforeach
                        </td>

                        <td class="text-center align-middle">
                            @foreach (App\Models\PresenceAndAbsence::where('term_id', session('current_term_id'))->whereIn('classroom_id', $similar_classrooms_id)->where('status', 'empty')->whereNotIn('classroom_id', $shown_classrooms_id)->orderBy('date')->get() as $relation)
                                {{ jdate($relation->date)->format('Y-m-d') }}
                                <br>
                            @endforeach
                        </td>
                        <td class="text-center align-middle">
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
    </div>
@endsection
