<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $fillable=['title','agenda','date','time','peoples'];
    protected $table="schedules";
}
