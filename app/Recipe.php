<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $table = 'recipes';
    protected $fillable = ['name', 'lastname', 'ci', 'bdate', 'email', 'meds'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
