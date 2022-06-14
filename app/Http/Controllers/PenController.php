<?php

namespace App\Http\Controllers;

use App\Models\Pen;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            return DataTables::of(Pen::query())
                ->editColumn('img',function ($row){
                    $link = asset('storage').'/'.$row->img;
                    return '<img src="'.$link.'" class="img-thumbnail" width="200" height="200" >';
                })
                ->addColumn('action',function ($row){
                    $btn = '<button type="button" data-id="'.$row->id.'" class="btn btn-success edit_btn"><i class="fa fa-edit"></i> </button>
                            <button data-id="'.$row->id.'" class="btn btn-danger delete_btn"><i class="fas fa-trash-alt"></i> </button>';
                    return $btn;
                })
                ->rawColumns(['action','img'])
                ->make(true);
        }

        return view('admin.pen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pen.create');
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
            'Name'=>'required|String',
            'title'=>'required|String',
            'sub_title'=>'required|String',
            'img'=>'required|image',
        ]);

        $data=$request->except('img');
        if ($request->hasFile('img')){
            $file=$request->file('img');
            if ($file->isValid()){
                $data['img']=$file->store('img','public');
            }
        }
        $pen=Pen::create($data);
        return view('admin.pen.index')->with('status','تم إضافة الخبر');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pen  $pen
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax()){
            $data = Pen::find($request->id);
            if($data){
                return response()->json($data,200);
            }else{
                return response()->json([],400);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pen  $pen
     * @return \Illuminate\Http\Response
     */
    public function edit(Pen $pen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pen  $pen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'Name'=>'required|String',
            'title'=>'required|String',
            'sub_title'=>'required|String',
            'img'=>'required|image',
        ]);
        $data=$request->except('img');
        if ($request->hasFile('img')){
            $file=$request->file('img');
            if ($file->isValid()){
                $data['img']=$file->storeAs('img','public');
            }
        }
        $pen=Pen::findOrFail($request->id);
        $pen->update($request->all());
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pen  $pen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
            try {
                $section=Pen::find($request->id)->delete();
                return response()->json('true',200);
            }Catch(Exception $e){
                return response()->json('false',400);
            }
    }
}