<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $table = 'reviews';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $guarded = ['id'];
    protected $fillable = ['customer_id', 'grooming_id','comment'];
}
