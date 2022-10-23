<?php

namespace App\Http\Controllers;

use App\Models\Grooming;
use App\Models\Customer;
use App\Models\Review;
use App\Models\Orderinfo;
use Illuminate\Http\Request;
use View;
use Validator;
use Redirect;
use Storage;
use File;
use Session;
use App\Cart;
use DB;

class GroomingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        $groomings = Grooming::withTrashed()->orderBy('id', 'DESC')->paginate(10);
        return View::make('pet_grooming.index',compact('groomings'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('pet_grooming.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $validator = Validator::make($request->all(), Grooming::$rules);

                    if ($validator->fails()) {
                        return redirect()->back()->withInput()->withErrors($validator);
                    }

                    if ($validator->passes()) {

                        $path = Storage::putFileAs('images/grooming', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);

                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;    
                            $input['password']  =  bcrypt($request->input('password'));
                            $grooming = Grooming::create($input);
                            // dd($grooming);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/grooming')->with('success','New grooming has been Added!');
                        } 

                    }  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grooming = Grooming::find($id);
        return view('pet_grooming.show',compact('grooming'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grooming = Grooming::find($id);
        return view('pet_grooming.edit',compact('grooming'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grooming = Grooming::find($id);

        $validator = Validator::make($request->all(), Grooming::$rules);
        
        if ($validator->fails()) {
            // dd($validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
                        $path = Storage::putFileAs('images/grooming', $request->file('image'),$request->file('image')->getClientOriginalName());

                        $request->merge(["imagePath"=>$request->file('image')->getClientOriginalName()]);

                        $input = $request->all();

                        if($file = $request->hasFile('image')) {
                            $file = $request->file('image') ;
                            $fileName = $file->getClientOriginalName();
                            $destinationPath = public_path().'/images' ;
                            // dd($fileName);
                            $input['imagePath'] = 'images/'.$fileName;            
                            $grooming->update($input);
                            // dd($grooming);
                            $file->move($destinationPath,$fileName);
                            return Redirect::to('/grooming')->with('success','grooming has been updated!');
                        } 
                    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grooming  $grooming
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grooming = Grooming::findOrFail($id);
        $grooming->delete();
        return Redirect::to('/grooming')->with('success','Pet Grooming Deleted!');
    }

     public function restore($id) {
        $grooming = Grooming::withTrashed()->where('id',$id)->restore();
        return  Redirect::route('grooming.index')->with('success','Pet Grooming Restored Successfully!');
    }

    public function shop()
    {
        // if (Auth::check())
       // {
        $groomings= Grooming::all();
        $groomings = Grooming::orderBy('id')->paginate(6);
        return view('shop.index', compact('groomings'));
           
        // }
        // return redirect()->route('user.signin');
    }

    public function postCheckout(Request $request){
        if (!Session::has('cart')) {
            return redirect()->route('shop.index');
        }


         $email = $request->input('email');
         $customer = DB::table('customers')
                    ->select('id')
                    ->where('customers.email', '=', $email)
                    ->first();
          // dd($email);

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        // dd($cart);
        try {
                    DB::beginTransaction();
                    $order = new Orderinfo();
                    // $customer = DB::table('customers')
                    // ->select('id')
                    // ->where('customers.id', '=', '1')
                    // ->first();
                    $order->customer_id = $customer->id;
                    $order->save();
                    // dd($order);
                    foreach($cart->groomings as $groomings){
                        $id = $groomings['grooming']['id'];
                        // dd($id);
                        DB::table('orderline')->insert(
                            ['grooming_id' => $id, 
                             'orderinfo_id' => $order->id,
                             // 'quantity' => $items['qty']
                            ]
                            );
                        // $stock = Stock::find($id);
                        // $stock->quantity = $stock->quantity - $items['qty'];
                        // $stock->save();
                        // dd($order);
                    }
                    // dd($order);
                }

                catch (\Exception $e) {
                    dd($e);
                    DB::rollback();
                    // dd($order);
                    return redirect()->route('shop.shoppingCart')->with('error', $e->getMessage());
                }
                DB::commit();
                        Session::forget('cart');
                        return redirect()->route('shop.index')->with('success','Successfully Purchased Your Products!!!');
            }

     public function getAddToCart(Request $request , $id){
        $grooming= Grooming::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        // $oldCart = Session::has('cart') ? $request->session()->get('cart'): null;

        $cart = new Cart($oldCart);
        $cart->add($grooming, $grooming->id);
        //$request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        // $request->session()->save();
        Session::save();
        return redirect()->route('shop.index');
        // dd(Session::all());
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($oldCart);
        return view('shop.shopping-cart', ['groomings' => $cart->groomings, 'totalPrice' => $cart->totalPrice]);
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->groomings) > 0) {
            Session::put('cart',$cart);
            Session::save();
        }else{
            Session::forget('cart');
        }
         return redirect()->route('shop.shoppingCart');
    }

    // public function getReduceByOne($id){
    //     $oldCart = Session::has('cart') ? Session::get('cart') : null;
    //     $cart = new Cart($oldCart);
    //     $cart->reduceByOne($id);
    //     if (count($cart->items) > 0) {
    //         Session::put('cart',$cart);
    //         Session::save();
    //     }else{
    //         Session::forget('cart');
    //     }        
    //     return redirect()->route('item.shoppingCart');
    // }

    public function review($id)
    {   
        $reviews = DB::table('customers')
        ->join('reviews', 'reviews.customer_id', '=', 'customers.id')
        ->join('groomings', 'groomings.id', '=', 'reviews.grooming_id')
        ->select('customers.imagePath as cusImage', 'customers.fname', 'customers.lname', 'reviews.comment', 'reviews.created_at')
        ->where('groomings.id', '=', $id)
        ->orderBy('reviews.id', 'DESC')
        ->paginate(5);

        // $customers = Customer::select("id", DB::raw("CONCAT(customers.fname,' ',customers.lname) as full_name"))
        // ->pluck('full_name', 'id');
        $groomings = Grooming::find($id);
        // dd($groomings);

        return view('shop.review',compact('reviews', 'groomings'));

    //     $customers = Customer::select("id", DB::raw("CONCAT(customers.fname,' ',customers.lname) as full_name"))
    //     ->pluck('full_name', 'id');
    //     $groomings = Grooming::find($id);

    //     return view('pet.edit',compact('pet','customers'));
    //     $groomings = Grooming::find($id);
    //     return view('shop.review',compact('groomings'));
    }

    public function reviewStore(Request $request)
    {
      $email = $request->input('email');
      $customers = DB::table('customers')
        ->select('id')
        ->where('customers.email', '=', $email)
        ->first();
      // $cusid = $customers->id;
      // dd($customers);

        try {
            DB::beginTransaction();
            $reviews = new Review;
                $reviews->customer_id = $customers->id;
                $reviews->grooming_id = $request->grooming_id;
                $reviews->comment = $request->comment;
                $reviews->save();
        }
        catch (\Exception $e) {
                    // dd($e);
                    DB::rollback();
                    return redirect()->back()->with('danger', 'Incorrect E-mail');
                }

        DB::commit();
        return redirect()->back()->with('success', 'Thanks for the review!');
    }

    public function history()
    {
        $orderinfos = DB::table('customers')
        ->join('orderinfo', 'orderinfo.id', '=', 'customers.id')
        ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
        ->join('groomings', 'groomings.id', '=', 'orderline.grooming_id')

        ->select('customers.fname', 'customers.lname', 'groomings.price','orderline.orderinfo_id', 'orderline.grooming_id', 'groomings.description')
        // ->where('groomings.id', '=', $id)
        ->orderBy('orderline.orderinfo_id', 'DESC')
        ->get();

        // $customers = Customer::select("id", DB::raw("CONCAT(customers.fname,' ',customers.lname) as full_name"))
        // ->pluck('full_name', 'id');
        // $groomings = Grooming::find($id);
        // dd($groomings);

        return view('history.history',compact('orderinfos'));
    }

    public function search(Request $request) {
        $search = $request->get('search');
        // dd($search);
        $orderinfos = DB::table('customers')
        ->join('orderinfo', 'orderinfo.id', '=', 'customers.id')
        ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
        ->join('groomings', 'groomings.id', '=', 'orderline.grooming_id')
        // ->where('consultations.employee_id', 'like', '%'.$search.'%')
        ->select('customers.fname', 'customers.lname', 'groomings.price','orderline.orderinfo_id', 'orderline.grooming_id', 'groomings.description')
        ->where('orderline.orderinfo_id', 'like', '%'.$search.'%')
        ->orWhere('groomings.description', 'like', '%'.$search.'%')
        ->orWhere('customers.fname', 'like', '%'.$search.'%')
        ->orWhere('customers.lname', 'like', '%'.$search.'%')
        ->paginate(10);
        return view('history.history', ['orderinfos' => $orderinfos]);
    }

}
