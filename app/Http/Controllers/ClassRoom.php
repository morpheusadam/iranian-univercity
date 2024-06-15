<?php

namespace App\Http\Controllers;

use App\Models\Classroom as ModelsClassroom;
use App\Models\EducationalGroup;
use App\Models\Entry;
use App\Models\Professor;
use App\Models\Term;
use App\Models\TimePeriod;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;

class ClassRoom extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = ModelsClassroom::all();
        $time_periods = TimePeriod::orderBy('id')->get();

        $show_lesson_group = true;
        $show_lesson_name = true;
        $show_professor_name = true;
        $show_status = true;
        $show_entry_year = true;
        $show_eg_name = true;

        return view('classrooms.index', compact('classrooms', 'time_periods', 'show_lesson_group', 'show_lesson_name', 'show_professor_name', 'show_status', 'show_entry_year', 'show_eg_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $time_periods = TimePeriod::orderBy('id')->get();

        return view('classrooms.create', compact('time_periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! ($request->has('lesson_id') || $request->has('professor_id') || $request->has('status') || $request->has('eg_id') || $request->has('entry_id'))) {
            return back()->with('failed', 'لطفا مقادیری را برای تعریف کلاس انتخاب کنید');
        }

        $keys = array_unique(array_merge(array_keys($request->lesson_id ?? []), array_keys($request->professor_id ?? []), array_keys($request->status ?? []), array_keys($request->eg_id ?? []), array_keys($request->entry_id ?? [])));
        $current_term = Term::find(session('current_term_id'));
        foreach ($keys as $key) {
            $array = explode('-', $key);

            $class['lesson_id'] = $request->lesson_id[$key] ?? null;
            $class['professor_id'] = $request->professor_id[$key] ?? null;
            $class['status'] = $request->status[$key] ?? null;
            $class['eg_id'] = $request->eg_id[$key] ?? null;
            $class['entry_id'] = $request->entry_id[$key] ?? null;
            $class['week_day'] = $array[0] + 1;
            $class['time_period_id'] = $array[1];
            // dd(Term::find($current_term));
            $class['term_id'] = Term::find($current_term)->value('id');

            ModelsClassroom::create($class);
        }

        return back()->with('success', 'کلاس ها با موفقیت تعریف شدند!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsClassroom $classroom)
    {
        $class_ids = array_unique(array_merge(array_keys($request->lesson_id ?? []), array_keys($request->professor_id ?? []), array_keys($request->status ?? []), array_keys($request->eg_id ?? []), array_keys($request->entry_id ?? [])));
        $current_term = Term::find(session('current_term_id'));

        foreach ($class_ids as $class_id) {
            $lesson_id = $request->lesson_id[$class_id] ?? null;
            $professor_id = $request->professor_id[$class_id] ?? null;
            $status = $request->status[$class_id] ?? null;
            $eg_id = $request->eg_id[$class_id] ?? null;
            $entry_id = $request->entry_id[$class_id] ?? null;
            $term_id = Term::find($current_term)->value('id');

            if (is_null($lesson_id) && is_null($professor_id) && is_null($status) && is_null($eg_id) && is_null($entry_id)) {
                ModelsClassroom::find($class_id)->delete();
            } else {
                ModelsClassroom::find($class_id)->update([
                    'lesson_id' => $lesson_id,
                    'professor_id' => $professor_id,
                    'status' => $status,
                    'eg_id' => $eg_id,
                    'entry_id' => $entry_id,
                    'term_id' => $term_id,

                ]);
            }
        }

        return redirect()->route('classrooms.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsClassroom $classroom)
    {
        $current_term_id = session('current_term_id');
        if ($classroom->term_id == $current_term_id && $classroom->delete()) {
            return redirect()->route('classrooms.index')->with('success', 'حذف با موفقیت انجام شد!');
        }

        return back()->with('error', 'خطایی رخ داد. لطفاً دوباره تلاش کنید.');
    }

    public function filter(Request $request)
    {
        $classrooms = ModelsClassroom::query();

        if (! $request->manually_select) {
            if ($request->has('professors')) {
                $classrooms = $classrooms->where(function (Builder $query) use ($request) {
                    foreach ($request->professors as $key => $professor_id) {
                        $professor = Professor::find($professor_id);
                        $query->orWhereIn('id', $professor->classrooms->pluck('id'));
                    }
                });
            }

            if ($request->has('educational_groups')) {
                $classrooms = $classrooms->where(function (Builder $query) use ($request) {
                    foreach ($request->educational_groups as $key => $eg_id) {
                        $educational_group = EducationalGroup::find($eg_id);
                        $query->orWhereIn('id', $educational_group->classrooms->pluck('id'));
                    }
                });
            }

            if ($request->has('entries')) {
                $classrooms = $classrooms->where(function (Builder $query) use ($request) {
                    foreach ($request->entries as $key => $entry_id) {
                        $entry = Entry::find($entry_id);
                        $query->orWhereIn('id', $entry->classrooms->pluck('id'));
                    }
                });
            }

            if (! is_null($request->status)) {
                $classrooms = $classrooms->where('status', $request->status);
            }
        } else {
            if ($request->has('classes')) {
                $classrooms = $classrooms->whereIn('id', $request->classes);
            }
        }
        $classrooms = $classrooms->get();
        $time_periods = TimePeriod::orderBy('id')->get();

        $show_lesson_group = request('show_lesson_group');
        $show_lesson_name = request('show_lesson_name');
        $show_professor_name = request('show_professor_name');
        $show_status = request('show_status');
        $show_entry_year = request('show_entry_year');
        $show_eg_name = request('show_eg_name');

        return view('classrooms.index', compact('classrooms', 'time_periods', 'show_lesson_group', 'show_lesson_name', 'show_professor_name', 'show_status', 'show_entry_year', 'show_eg_name'));
    }
}
