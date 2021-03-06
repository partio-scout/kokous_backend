<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = ['user_id','comment','public'];
    
    public function imageable(){
        return $this->morphTo();
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
