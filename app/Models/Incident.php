<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $table = 'incidents';


    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function scopeSearch($query, $name)
    {
        return $query
            ->where('name', 'like', '%' .$name. '%');
    }
}
