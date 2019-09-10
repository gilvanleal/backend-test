<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recourse;

class Item extends Model
{
    //
    protected $fillable = ['name', 'point'];

    public function recourses()
    {
        return $this->hasMany(Recourse::class);
    }
}

