<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use softDeletes;

    public $table = 'customers';
    // public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id', 'imagePath'];
    protected $fillable = ['fname','lname',
        'title','addressline','town','zipcode',
        'phone','email','imagePath'
    ];

   public static $rules = [ 'title' =>'required|max:4',
                            'lname'=>'required|alpha',
                            'fname'=>'required',
                            'addressline'=>'required',
                            'phone'=>'required',
                            'town'=>'required',
                            'zipcode'=>'required',
                            'email'=>'required|email|unique:customers',
                            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
                            ];
}
