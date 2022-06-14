<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::of(Section::query())
                ->addColumn('action',function ($row){
                    $btn = '<button data-id="'.$row->id.'" data-name="'.$row->section_name.'" class="btn btn-success edit_btn"><i class="fa fa-edit"></i> </button>
                            <button data-id="'.$row->id.'" class="btn btn-danger delete_btn"><i class="fas fa-trash-alt"></i> </button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.section.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.section.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_name'=>'required|String'
        ]);
        $section=Section::create($request->all());
        return redirect('sections')->with('status','تم اضافة القسم');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section ,$id)
    {
        $section=Section::findOrFail($id);
        return view('admin.section.edit',compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section=Section::findOrFail($request->id);
        $request->validate([
            'section_name'=>'required|String'
        ]);
        $section->update($request->all());
        return 1;
        //return redirect('admin.section.index')->with('status','تم تعديل القسم');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
            try {
                $section=Section::find($request->id)->delete();
                return response()->json('true',200);
            }Catch(Exception $e){
            return response()->json('false',400);
    }
    }
}
