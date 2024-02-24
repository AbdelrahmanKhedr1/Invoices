<?php

namespace App\Http\Controllers;

use App\Http\Requests\section\SectionCreate;
use App\Http\Requests\section\SectionEdit;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:sections', ['only' => ['index']]);
        $this->middleware('permission:add section', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit section', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete section', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.section' , compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.section_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionCreate $request)
    {
        $data = $request->validated();
        $data['created_by']= Auth::user()->name ;
        Section::create($data);
        session()->flash('Add');
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section_id = Section::findOrFail($id);
        return view('sections.section_edit', compact('section_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionEdit $request, string $id)
    {
        Section::findOrFail($id)->update($request->validated());
        session()->flash('Edit');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Section::where('id',$id)->delete();
        session()->flash('Delete');

        return back();
    }
}
