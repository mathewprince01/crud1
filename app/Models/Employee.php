<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //   protected $table = 'employees';

    protected $guarded=[];

     public function experiences(){
        return $this->hasMany(Experience::class,'employee_id');
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
}
