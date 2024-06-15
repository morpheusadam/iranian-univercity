<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resource=Collage::all();
        return view('collages.index',compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('collages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        Collage::create($data);
        return back()->with('success', 'دانشکده با موفقیت ایجاد شد!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collage $collage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $collage=Collage::find($id);
        return view('collages.edit',compact('collage'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $collage=Collage::find($id);
        $collage->name=$request->name;
        $collage->save();
        return back()->with('success', 'دانشکده با موفقیت ویرایش شد!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collage $collage)
    {
        //
    }
}
