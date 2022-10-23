<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use View;
use Validator;
use Redirect;
use Storage;
use File;
use DB;
use App\Models\Customer;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $pets = DB::table('pets')
        ->join('customers', 'customers.id', '=', 'pets.id')
        ->select('pets.name', 'pets.customer_id', 'pets.id', 'pets.species', 'pets.breed', 'pets.gender', 'pets.age', 'pets.color', 'pets.imagePath as petImage', 'pets.deleted_at','customers.fname', 'customers.lname', 'customers.imagePath as cusImage')->orderBy('id', 'DESC')->paginate(10);
        return View::make('pet.index',compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $customers = Customer::select("id", DB::raw("CONCAT(customers.fname,' ',customers.lname) as full_name"))
        ->pluck('full_name', 'id');
        return View::make('pet.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), Pet::$rules);

                    if ($validator->fails()) {
                        dd($validator);
                        return redirect()->back()->withInput()->withErrors($validator);
                    }

                    if ($validator->passes()) {
                        $path = Storage::putFileAs('images/pet', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);


                        $input = $request->all();
                        // dd($input);
                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            // $fileName = uniqid().'_'.$file->getClientOriginalName();
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;            
                            $pet = pet::create($input);
                            // dd($pet);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/pet')->with('success','New pet has been Added!');
                        } 

                    }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $pets = DB::table('pets')
        ->join('customers', 'customers.id', '=', 'pets.customer_id')
        ->select('pets.name', 'pets.customer_id', 'pets.id', 'pets.species', 'pets.breed', 'pets.gender', 'pets.age', 'pets.color', 'pets.imagePath as petImage', 'customers.fname', 'customers.lname', 'customers.imagePath as cusImage')
        ->where('pets.id', '=', $id)
        ->get();
        // dd($pets);
        return view('pet.show',compact('pets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $customers = Customer::select("id", DB::raw("CONCAT(customers.fname,' ',customers.lname) as full_name"))
        ->pluck('full_name', 'id');
        $pet = Pet::find($id);
        return view('pet.edit',compact('pet','customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pet = Pet::find($id);

        $validator = Validator::make($request->all(), Pet::$rules);
        
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
                        $path = Storage::putFileAs('images/pet', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);

                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;            
                            $pet->update($input);
                            // dd($pet);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/pet')->with('success','Pet has been updated!');
                        } 
                    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pet = pet::findOrFail($id);
        $pet->delete();
        return Redirect::to('/pet')->with('success','Pet Deleted!');
    }

     public function restore($id) {
        $pet = pet::withTrashed()->where('id',$id)->restore();
        return  Redirect::route('pet.index')->with('success','Pet Restored Successfully!');
    }
}
