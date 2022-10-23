<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use View;
use Validator;
use Redirect;
use Storage;
use File;
use Auth;
use DB;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::withTrashed()->orderBy('id', 'DESC')->paginate(10);
         // dd($customers);
        return View::make('employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return View::make('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), Employee::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {

            $user = new User([
                'name' => $request->input('fname').' '.$request->lname,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);
            // dd($user);
            $user->save();

            $path = Storage::putFileAs('images/employee', $request->file('image'),$request->file('image')->getClientOriginalName());

            $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);

            // $input['user_id'] = $user->id;
            // $input = $request->all();
            // dd($input);
            if($file = $request->hasFile('image')) {
                $file = $request->file('image') ;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                // dd($fileName);
                // $input['imagePath'] = 'images/'.$fileName;    
                // $input['password']  =  bcrypt($request->input('password'));
                // $employee = Employee::create($input);
                // dd($employee);
                $employee = new Employee;
                $employee->user_id = $user->id;
                $employee->fname = $request->fname;
                $employee->lname = $request->lname;
                $employee->addressline = $request->addressline;
                $employee->town = $request->town;
                $employee->zipcode = $request->zipcode;
                $employee->imagePath= 'images/'.$fileName;
                $employee->save();

                $file->move($destinationPath,$fileName);
                return Redirect::to('/employee')->with('success','New Employee has been Added!');
            } 
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $employees = DB::table('users')
        ->join('employees', 'employees.user_id', '=', 'users.id')
        // ->select('users.id as user', 'pets.customer_id', 'pets.id', 'pets.species', 'pets.breed', 'pets.gender', 'pets.age', 'pets.color', 'pets.imagePath as petImage', 'pets.deleted_at','customers.fname', 'customers.lname', 'customers.imagePath as cusImage')
        ->where('employees.id', '=', $id)
        ->get();
        // return View::make('pet.index',compact('pets'));
        // $employee = Employee::find($id);
        return view('employee.show',compact('employees'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $employee = Employee::find($id);

        $validator = Validator::make($request->all(), Employee::$rules);
        
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
                        $hashedPassword = Auth::user()->password;
                        if (\Hash::check($request->confirmpassword , $hashedPassword ))
                        {
                            $path = Storage::putFileAs('images/employee', $request->file('image'),$request->file('image')->getClientOriginalName());

                            $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);

                            $input = $request->all();

                            if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;    
                            $input['password']  =  bcrypt($request->input('password'));        
                            $employee->update($input);
                            // dd($employee);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/employee')->with('success','Employee has been updated!');
                            } 
                        } 
                        else{
                            session()->flash('message','old password doesnt matched!');
                            return redirect()->back()->withInput();
                            }
                    }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return Redirect::to('/employee')->with('success','Employee Deleted!');
    }

     public function restore($id) {
        $employee = Employee::withTrashed()->where('id',$id)->restore();
        // dd($employee);
        // ->restore();
        return  Redirect::route('employee.index')->with('success','Employee Restored Successfully!');
    }

    public function getSignup(){
        return view('employee.signup');
    }

 
    public function postSignup(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'addressline' => 'required',
            'town' => 'required',
            'zipcode' => 'required|numeric',
            'email' => 'email| required| unique:users',
            'password' => 'required| min:4'
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'addressline' => $request->input('addressline'),
            'town' => $request->input('town'),
            'zipcode' => $request->input('zipcode'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $input = $request->all();

        $validator = Validator::make($request->all(), User::$rules);
        if ($validator->fails()) {
                    // dd($validator);
                        return redirect()->back()->withInput()->withErrors($validator);
                    }

                    if ($validator->passes()) {


                        $path = Storage::putFileAs('images/employee', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);

                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;    
                            $input['password']  =  bcrypt($request->input('password'));
                            $employee = Employee::create($input);
                            // dd($employee);
                            $file->move($destinationPath,$fileName);
                            // Auth::login($user);
                            return redirect()->route('employee.signin');
                        } 

                    }   

    }
    public function getProfile(){
        return view('employee.profile');
    }

    public function getLogout(){
        Auth::logout();
        return redirect('/signin');
    }

    public function getSignin(){
        return view('employee.signin');
    }
        
    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
         if(Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])){
            return redirect()->route('employee.profile');
        }else{
            return redirect()->back();
        };
     }

}
