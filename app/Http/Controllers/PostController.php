<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            return DataTables::of(Post::query())
                ->editColumn('img',function ($row){
                    $link = asset('storage').'/'.$row->img;
                    return '<img src="'.$link.'" class="img-thumbnail" width="200" height="200" >';
                })
                ->addColumn('section_name',function ($row){
                    return $row->sections->section_name;
                })
                ->addColumn('action',function ($row){
                    $btn = '<button type="button" data-id="'.$row->id.'" class="btn btn-success edit_btn"><i class="fa fa-edit"></i> </button>
                            <button data-id="'.$row->id.'" class="btn btn-danger delete_btn"><i class="fas fa-trash-alt"></i> </button>';
                    return $btn;
                })
                ->rawColumns(['action','section_name','img'])
                ->make(true);
        }

        $section = Section::all();
        return view('admin.post.index',[
            'section' => $section
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $section=Section::all();
        return view('admin.post.create',compact('section'));
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
           'title'=>'required|String',
           'sub_title'=>'required|String',
           'img'=>'required|image',
           'section_id'=>'required',
        ]);

        $data=$request->except('img');
        if ($request->hasFile('img')){
            $file=$request->file('img');
            if ($file->isValid()){
                $data['img']=$file->store('img','public');
            }
        }
        $section=Section::all();
        $post=Post::create($data);
        return view('admin.post.index',[
            'section'=>$section
        ])->with('status','تم إضافة الخبر');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax()){
            $data = Post::find($request->id);
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'=>'required|String',
            'sub_title'=>'required|String',
            'img'=>'nullable|image',
            'section_id'=>'required',
        ]);
        $data=$request->except('img');
        if ($request->hasFile('img')){
            $file=$request->file('img');
            if ($file->isValid()){
                $data['img']=$file->storeAs('img','public');
            }
        }
        $post=Post::findOrFail($request->id);
        $post->update($request->all());
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax())
            try {
                $section=Post::find($request->id)->delete();
                return response()->json('true',200);
            }Catch(Exception $e){
                return response()->json('false',400);
            }

    }
}
