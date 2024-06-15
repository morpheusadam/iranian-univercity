<?php

namespace App\Http\Controllers;

use App\Models\EducationalGroup as ModelsEducationalGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EducationalGroup extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educational_groups = ModelsEducationalGroup::latest()->paginate(10);
        return view('educational-groups.index', compact('educational_groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('educational-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:educational_groups,name'],
            'initials' => ['required', 'string', 'max:5', 'unique:educational_groups,initials'],
        ]);

        if (ModelsEducationalGroup::create($validated))
            return back()->with('success', 'گروه آموزشی با موفقیت ایجاد شد!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ModelsEducationalGroup $educational_group)
    {
        return view('educational-groups.edit', compact('educational_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsEducationalGroup $educational_group)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique('educational_groups', 'name')->ignore($educational_group->id)],
            'initials' => ['nullable', 'string', 'max:5', Rule::unique('educational_groups', 'initials')->ignore($educational_group->id)],
        ]);

        if ($educational_group->update($validated))
            return redirect()->route('educational-groups.index')->with('success', 'ویرایش با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsEducationalGroup $educational_group)
    {
        if ($educational_group->delete())
            return redirect()->back()->with('success', 'حذف با موفقیت انجام شد!');
    }
}
