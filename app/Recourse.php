<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Survivor;
use App\Item;

class Recourse extends Model
{
    protected $fillable = ['amount', 'item_id', 'survivor_id'];
    protected $appends = ['item_name', 'item_point', 'points'];
    protected $attributes = ['amount' => 0];

     /**
     * Get the survivor that owns the resource.
     */
    public function survivor()
    {
        return $this->belongsTo(Survivor::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function getItemNameAttribute()
    {
        return $this->item->name;
    }

    public function getItemPointAttribute()
    {
        return $this->item->point;
    }

    public function getPointsAttribute()
    {
        return $this->item->point * $this->amount;
    }
}
