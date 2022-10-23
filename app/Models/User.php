<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public $table = 'users';
    // public $primaryKey = 'id';
    // public $timestamps = true;

    // protected $guarded = ['id', 'imagePath'];

    // public static $rules = [ 'name' =>'required',
    //                         'addressline' =>'required',
    //                         'town' =>'required',
    //                         'zipcode' =>'required|numeric',
    //                         'email'=>'required',
    //                         'password'=>'required',
    //                         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'];
}
