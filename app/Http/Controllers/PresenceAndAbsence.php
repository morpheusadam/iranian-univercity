<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Location;
use App\Models\presenceAndAbsence as ModelsPresenceAndAbsence;
use App\Models\Term;
use App\Models\TimePeriod;
use Illuminate\Support\Facades\Redirect;
use misterspelik\LaravelPdf\Facades\Pdf;
use Morilog\Jalali\Jalalian;

class presenceAndAbsence extends Controller
{
    public function index()
    {
        $current_term = Term::find(session('current_term_id'));
        $classrooms = Classroom::whereIn('id', $current_term->classrooms->pluck('id'))->get();
        $time_periods = TimePeriod::orderBy('id')->get();
        $locations = Location::orderBy('number')->get();
        $startOfWeek = $this->firstDayOfWeek(); // Shamsi week

        return view('presence-and-absence.index', compact('classrooms', 'locations', 'time_periods', 'startOfWeek'));
    }

    public function firstDayOfWeek()
    {
        $year = request('year');
        $month = request('month');
        $day = request('day');

        $selected_date = ($year && $month && $day) ? (new Jalalian($year, $month, $day)) : (jdate(now()));
        if ($selected_date->isStartOfWeek())
            return $selected_date->toCarbon();
        else
            for ($counter = -1; $counter >= -6; $counter--)
                if ($selected_date->addDays($counter)->isStartOfWeek())
                    return $selected_date->addDays($counter)->toCarbon();
    }

    public function determine()
    {
        foreach (request('status') as $class_id_and_date => $status) {
            $array = explode('.', $class_id_and_date);
            $class_id = $array[0];
            $date = $array[1];

            if (is_null($status)) {
                $relation = ModelsPresenceAndAbsence::where('term_id', session('current_term_id'))
                    ->where('classroom_id', $class_id)
                    ->where('date', $date)
                    ->first();

                if ($relation)
                    $relation->delete();

                continue;
            }

            ModelsPresenceAndAbsence::updateOrCreate([
                'term_id' => session('current_term_id'),
                'classroom_id' => $class_id,
                'date' => $date
            ], [
                'status' => $status
            ]);
        }

        return back()->with('success', 'حضور غیاب کلاس ها با موفقیت ثبت شد!');
    }

    public function history()
    {
        $classrooms = Term::find(session('current_term_id'))
            ->classrooms()
            ->orderBy('week_day')
            ->orderBy('time_period_id')
            ->get();

        return view('presence-and-absence.history', compact('classrooms'));
    }

    public function preview()
    {
        $classrooms = Term::find(session('current_term_id'))
            ->classrooms()
            ->orderBy('week_day')
            ->orderBy('time_period_id')
            ->get();

        $pdf = Pdf::loadView('presence-and-absence.pdf', compact('classrooms'))->stream();
    }

    public function download()
    {
        $classrooms = Term::find(session('current_term_id'))
            ->classrooms()
            ->orderBy('week_day')
            ->orderBy('time_period_id')
            ->get();

        $pdf = Pdf::loadView('presence-and-absence.pdf', compact('classrooms'))->download();
    }
}
