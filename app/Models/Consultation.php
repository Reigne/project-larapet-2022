<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use HasFactory;
    use softDeletes;

    public $table = 'consultations';
    // public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];
    protected $fillable = ['pet_id', 'description', 'message', 'comment', 'price', 'employee_id'];

    public static $rules = [ 'description' =>'required',
               'pet'=>'required',
               'message'=>'required',
               'price'=>'required|numeric',
               'comment'=>'required',
             ];
}
