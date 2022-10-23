<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use softDeletes;

    public $table = 'employees';
    // public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id', 'imagePath'];

    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'addressline',
        'town',
        'zipcode',
        'imagePath' 
    ];

    public static $rules = [
                            'fname' =>'required',
                            'lname' =>'required',
                            'addressline' =>'required',
                            'town' =>'required',
                            'zipcode' =>'required|numeric',
                            'email'=>'required',
                            'password'=>'required',
                            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'];
}
