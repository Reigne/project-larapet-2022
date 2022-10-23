<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grooming extends Model
{
    use HasFactory;
    use softDeletes;

    public $table = 'groomings';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id','imagePath'];
    protected $fillable = ['description', 'price', 'imagePath', 'email'];

    public static $rules = [ 'description' => 'required',
               'price'=>'required|numeric',
               'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];
}
