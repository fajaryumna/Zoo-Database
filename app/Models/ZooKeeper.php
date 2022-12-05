<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZooKeeper extends Model
{
    use HasFactory;
    protected $table = 'zoo_keeper';
    protected $guarded = []; 
    public $timestamps = false;

}
