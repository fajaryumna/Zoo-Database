<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    use HasFactory;
    protected $table = 'animal';
    protected $guarded = []; 
    public $timestamps = false;
}
