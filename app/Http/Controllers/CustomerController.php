<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use View;
use Validator;
use Redirect;
use Storage;
use File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::withTrashed()->orderBy('id', 'DESC')->paginate(10);
         // dd($customers);
        return View::make('customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return View::make('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                    $validator = Validator::make($request->all(), Customer::$rules);

                    if ($validator->fails()) {
                        return redirect()->back()->withInput()->withErrors($validator);
                    }

                    if ($validator->passes()) {
                        $path = Storage::putFileAs('images/customer', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);


                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            // $fileName = uniqid().'_'.$file->getClientOriginalName();
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;            
                            $customer = Customer::create($input);
                            // dd($customer);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/customer')->with('success','New Customer has been Added!');
                        } 

                    }     
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $validator = Validator::make($request->all(), Customer::$rules);
        
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
                        $path = Storage::putFileAs('images/customer', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);


                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;            
                            $customer->update($input);
                            // dd($customer);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/customer')->with('success','Customer has been updated!');
                        } 
                    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return Redirect::to('/customer')->with('success','Customer Deleted!');
    }

     public function restore($id) {
        $customer = Customer::withTrashed()->where('id',$id)->restore();
        // dd($customer);
        // ->restore();
        return  Redirect::route('customer.index')->with('success','Customer Restored Successfully!');
    }

}
