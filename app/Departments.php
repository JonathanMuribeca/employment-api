<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
  protected $primaryKey = 'department_id';
  protected $fillable = ['department_name','manager_id'];
  public $timestamps = false;

}
