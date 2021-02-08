<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    protected $table = 'job_history';
    protected $primaryKey = 'job_history_id';
    protected $fillable = [
        'start_date',
        'end_date'
    ];
    public $timestamps = false;
}
