<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $region = $request->get('regions');
        $persons = \App\Person::with('region')
                    ->where('region_id','LIKE',"%$region%")
                    ->paginate(5);
        return view('persons.index',['persons'=>$persons]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persons.create');
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
            "name" => "required|min:5|max:200",
            "address" => "required|min:5|max:1000",
            "regions" => "required",
            "income" => "required|digits_between:0,10",
        ])->validate();

        $new_person = new \App\Person;

        $new_person->name = $request->get('name');
        $new_person->address = $request->get('address');
        $new_person->income = $request->get('income');
        $new_person->region_id = $request->get('regions');
        $new_person->save();

        return redirect()->route('persons.index')->with('status', 'Person Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = \App\Person::findOrFail($id);
        return view('persons.edit',['person'=>$person]);
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
            "name" => "required|min:5|max:200",
            "address" => "required|min:5|max:1000",
            "regions" => "required",
            "income" => "required|digits_between:0,10",
        ])->validate();

        $person = \App\Person::findOrFail($id);

        $person->name = $request->get('name');
        $person->address = $request->get('address');
        $person->income = $request->get('income');
        $person->region_id = $request->get('regions');
        $person->save();

        return redirect()->route('persons.edit',['id'=>$person->id])->with('status', 'Person Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = \App\Person::findOrFail($id);
        $person->delete();

        return redirect()->route('persons.index')->with('status', 'Person Successufully Deleted');
    }
}
