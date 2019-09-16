<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recourse;

class Item extends Model
{
    //
    protected $fillable = ['name', 'point'];
    public $timestamps = false;

    public function recourses()
    {
        return $this->hasMany(Recourse::class, 'recourse_id');
    }
}

