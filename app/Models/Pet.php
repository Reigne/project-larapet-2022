<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory;
    use softDeletes;

    public $table = 'pets';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id', 'imagePath'];
    protected $fillable = ['customer_id','species','breed',
        'name','gender','color','age',
        'imagePath'
    ];

    public static $rules = [ 'customer_id'=>'numeric',
                'species'=>'required|alpha',
                'breed'=>'required|alpha',
                'name'=>'required|alpha',
                'gender'=>'required|alpha',
                'color'=>'required|alpha',
                'age' => 'numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];
}
