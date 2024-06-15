<?php

namespace App\Http\Controllers;

use App\Models\Entry as ModelsEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Entry extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = DB::table('entries')->orderBy('year')->paginate(10);
        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => ['required', 'integer', 'unique:entries,year'],
        ]);

        if (ModelsEntry::create($validated))
            return back()->with('success', 'سال ورودی با موفقیت اضافه شد!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsEntry $entry)
    {
        return view('entries.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsEntry $entry)
    {
        $validated = $request->validate([
            'year' => ['required', 'integer', Rule::unique('entries', 'year')->ignore($entry->id)],
        ]);

        if ($entry->update($validated))
            return redirect()->route('entries.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsEntry $entry)
    {
        if ($entry->delete())
            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
    }
}
