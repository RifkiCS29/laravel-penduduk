<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = \App\Region::paginate(5);
        return view('regions.index',['regions'=>$regions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(),[
            "name" => "required|min:5|max:35",
        ])->validate();

        $new_region = new \App\Region;
        $new_region->name = $request->get('name');

        $new_region->save();
        return redirect()->route('regions.index')->with('status', 'Region Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = \App\Region::findOrFail($id);
        return view('regions.show',['region'=>$region]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = \App\Region::findOrFail($id);
        return view('regions.edit',['region'=>$region]);
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
        \Validator::make($request->all(),[
            "name" => "required|min:5|max:35",
        ])->validate();

        $category = \App\Region::findOrFail($id);

        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('regions.index',['id'=>$id])->with('status','Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = \App\Region::findOrFail($id);
        $region->delete();

        return redirect()->route('regions.index')->with('status', 'Category Successfully deleted');
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');

        $regions = \App\Region::where('name', 'LIKE', "%$keyword%")->get();
        return $regions;
    }
}
