<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $primaryKey = 'job_id';
    protected $fillable = ['job_title','min_salary','max_salary'];
    public $timestamps = false;
}
