<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Location as ModelsLocation;
use App\Models\Term;
use App\Models\TimePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class Location extends Controller
{
    public function __construct()
    {
        $this->middleware('term_exists')->only('setLocations');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = DB::table('locations')->orderBy('number')->paginate(10);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => ['required', 'integer', 'unique:locations,number'],
        ]);

        if (ModelsLocation::create($validated))
            return back()->with('success', 'مکان برگزاری با موفقیت اضافه شد!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsLocation $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsLocation $location)
    {
        $validated = $request->validate([
            'number' => ['required', 'integer', Rule::unique('locations', 'number')->ignore($location->id)],
        ]);

        if ($location->update($validated))
            return redirect()->route('locations.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsLocation $location)
    {
        if ($location->delete())
            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
    }

    public function determine()
    {
        $classrooms = Classroom::all();
        $time_periods = TimePeriod::orderBy('id')->get();

        $show_lesson_group = true;
        $show_lesson_name = true;
        $show_professor_name = true;
        $show_status = true;
        $show_entry_year = true;
        $show_eg_name = true;

        return view('locations.determine', compact('classrooms', 'time_periods', 'show_lesson_group', 'show_lesson_name', 'show_professor_name', 'show_status', 'show_entry_year', 'show_eg_name'));
    }

    public function setLocations()
    {
        foreach (request('location_id') as $classroom_id => $number) {
            $relation = DB::table('classroom_location_term')->where('classroom_id', $classroom_id)->where('term_id', session('current_term_id'))->first();

            if (is_null($relation)) {
                DB::table('classroom_location_term')->insert([
                    'classroom_id' => $classroom_id,
                    'term_id' => session('current_term_id'),
                    'location_id' => $number
                ]);
            } else {
                DB::table('classroom_location_term')->where('classroom_id', $classroom_id)->where('term_id', session('current_term_id'))->update([
                    'location_Id' => $number
                ]);
            }
        }

        return redirect()->route('locations.determine')->with('success', 'تعیین مکان های برگزاری با موفقیت انجام شد!');
    }
}
