<?php

namespace App\Http\Controllers;

use App\Article;
use App\Annotation;
use App\Http\Requests\AnnotationsRequest;
use Illuminate\Http\Request;

class AnnotationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $create = Annotation::create($request->all());
        /*
        event(new \App\Events\ModelChanged(['articles']));
        event(new \App\Events\AnnotationCreated($annotation));
        */
        return response()->json($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Annotation::find($id);
        $user = $show->user()->get()[0];

        return response()->json(array('id'=>$show->id, 'content'=> $show->content, 'user_id' => $show->user_id, 'article_id'=> $show->article_id, 'name'=> $user->name, 'email'=> $user->email));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $edit = Annotation::find($id)->update(['content'=>$request->content]);

        return response()->json([],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $edit = Annotation::find($id)->update($request->all());
        
        return response()->json([],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Annotation::find($id)->delete();

        return response()->json([],204);
    }
}
