<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\EducationalGroup;
use App\Models\Entry;
use App\Models\Location;
use App\Models\Professor;
use App\Models\Term;
use App\Models\TimePeriod;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;
use misterspelik\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Response;
class Schedule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->filter($request, true);
    }

    /**
     * Display the specified resource.
     */
    public function preview(Request $request)
    {
        $pdf = $this->Prepare_PDF($request);
        return $pdf->stream();
    }

    public function download(Request $request)
    {
        $pdf = $this->Prepare_PDF($request);
        return $pdf->download('schedule.pdf');
    }

    public function Prepare_PDF(Request $request)
    {
        $classrooms = $this->filterData($request)->get();
        $time_periods = TimePeriod::orderBy('id')->get();
        $locations = Location::orderBy('number')->get();
        // $locations = Location::whereIn('id', DB::table('classroom_location_term')->where('term_id', session('current_term_id'))->pluck('location_id'))->get();

        $pdf = Pdf::loadView('schedule.pdf', compact('classrooms', 'locations', 'time_periods'));
        return $pdf;
    }
    public function Prepare_word(Request $request){
        $classrooms = $this->filterData($request)->get();
        $time_periods = TimePeriod::orderBy('id')->get();
        $locations = Location::orderBy('number')->get();
        $headers=array(
            'Content-type'=>'text/html',
            'Content-Disposition'=>'attachment,Filename=report.docx'
        );
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();
        $tableStyle = array(
            'borderColor' => '006699',
            'borderSize'  => 6,
            'cellMargin'  => 50
        );
        $firstRowStyle = array('bgColor' => '66BBFF');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);

        $table = $section->addTable([$tableStyle]);
        $table->addRow(["تست"], ["تست2"]);
         $table->addCell([$classrooms], [$locations]);






//
//        $section->addText($description);
//
//
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('report.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('report.docx'));
//        return Response::make($description,200, $headers);
    }
    public function filter(Request $request, $first_time = false)
    {
        $classrooms = $this->filterData($request)->get();
        $time_periods = TimePeriod::orderBy('id')->get();
        $locations = Location::orderBy('number')->get();
        // $locations = Location::whereIn('id', DB::table('classroom_location_term')->where('term_id', session('current_term_id'))->pluck('location_id'))->get();

        $show_lesson_group = $first_time ? true : request('show_lesson_group');
        $show_lesson_name = $first_time ? true : request('show_lesson_name');
        $show_professor_name = $first_time ? true : request('show_professor_name');
        $show_status = $first_time ? true : request('show_status');
        $show_entry_year = $first_time ? true : request('show_entry_year');
        $show_eg_name = $first_time ? true : request('show_eg_name');

        return view('schedule.index', compact('classrooms', 'locations', 'time_periods',  'show_lesson_group', 'show_lesson_name', 'show_professor_name', 'show_status', 'show_entry_year', 'show_eg_name'));
    }

    public function filterData(Request $request)
    {
        $current_term = Term::find(session('current_term_id'));
        $classrooms = Classroom::whereIn('id', $current_term->classrooms->pluck('id'));

        if (!$request->manually_select) {
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

            if (!is_null($request->status))
                $classrooms = $classrooms->where('status', $request->status);
        } else {
            if ($request->has('classes')) {
                $classrooms = $classrooms->whereIn('id', $request->classes);
            }
        }

        return $classrooms;
    }
}
