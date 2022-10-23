<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationInfo extends Model
{
    use HasFactory;
    protected $table = 'ConsultationInfo';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ['pet_id'];
}
