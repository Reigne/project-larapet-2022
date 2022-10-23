<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Pet;
use Illuminate\Http\Request;
use View;
use Validator;
use Redirect;
use Storage;
use File;
use DB;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations = DB::table('pets')
        ->join('consultations', 'consultations.pet_id', '=', 'pets.id')
        ->select('pets.id','pets.name as petname','consultations.message','consultations.comment','consultations.id', 'consultations.pet_id', 'consultations.description', 'consultations.price', 'consultations.employee_id', 'consultations.deleted_at')
        ->paginate(10);
        // dd($consultations);
        return View::make('consultation.index',compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $pets = Pet::select("id", DB::raw("CONCAT(pets.id,' - ',pets.name) as full_name"))
        ->pluck('full_name', 'id');
        return View::make('consultation.create',compact('pets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $consultation = Consultation::create($input);
        }
        catch (\Exception $e) {
                    dd($e);
                    DB::rollback();
                    return redirect()->route('consultation.create')->with('error', $e->getMessage());
                }

        DB::commit();
        return redirect()->route('consultation.index')->with('success','Successfully Consultation Sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $consultations = DB::table('pets')
            ->leftJoin('consultations','consultations.pet_id','=','pets.id')
            ->select('pets.id','pets.name','consultations.message','consultations.comment','consultations.id', 'consultations.pet_id', 'consultations.description', 'consultations.price', 'consultations.employee_id')
            ->where('consultations.id', '=', $id)
            ->get();

            // dd($consultations);
        return View::make('consultation.show',compact('consultations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consultations = Consultation::find($id);
        return view('consultation.edit',compact('consultations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultation $consultation)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $consultation->update($input);
        }
        catch (\Exception $e) {
                    // dd($e);
                    DB::rollback();
                    return redirect()->route('consultation.edit')->with('error', $e->getMessage());
                }

        DB::commit();
        return redirect()->route('consultation.index')->with('success','Comment has succesfully sent!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultation  $consultation
     * @return \Illuminate\Http\Response
     */
      public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();
        return Redirect::to('/consultation')->with('success','Consultation Deleted!');
    }

     public function restore($id) {
        $consultation = Consultation::withTrashed()->where('id',$id)->restore();
        // dd($customer);
        // ->restore();
        return  Redirect::route('consultation.index')->with('success','Consultation Restored Successfully!');
    }

     public function search(Request $request) {
        $search = $request->get('search');
        $consultations = DB::table('pets')
        ->join('consultations', 'consultations.pet_id',  '=', 'pets.id')
        // ->join('users', 'users.id', '=', 'consultations.employee_id')
        ->select('pets.id','pets.name as petname','consultations.message','consultations.comment','consultations.id', 'consultations.pet_id', 'consultations.description', 'consultations.price', 'consultations.employee_id' ,'consultations.deleted_at')
        // ->where('consultations.employee_id', 'like', '%'.$search.'%')
        ->where('consultations.pet_id', 'like', '%'.$search.'%')
        ->orWhere('consultations.id', 'like', '%'.$search.'%')
        ->orWhere('description', 'like', '%'.$search.'%')
        ->orWhere('pets.name', 'like', '%'.$search.'%')
        ->paginate(10);

        return view('consultation.index', ['consultations' => $consultations]);
    }
}
