<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'hire_date',
        'salary',
        'commission_pct',
        'manager_id',
    ];
    public $timestamps = false;
}
