<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Recourse;

class Survivor extends Model
{
    //
    // protected $guarded = ['infected'];
    protected $appends = ['age', 'is_infected', 'location'];
    protected $fillable = ['name', 'birth', 'gender', 'latitude', 'longitude'];
    protected $guarded = ['recourses'];
    protected $attributes = ['infected' => 0, 'birth' => '2019-01-01'];

    public function recourses()
    {
        return $this->hasMany(Recourse::class);
    }

    public function getLocationAttribute()
    {
        return ['latitude' => $this->attributes['latitude'], 'longitude' => $this->attributes['longitude']];
    }

    public function getIsInfectedAttribute()
    {
        return $this->attributes['infected'] >= 3;
    }

    public function getAgeAttribute()
    {
        $now = new \DateTime();
        $dob = new \DateTime($this->attributes['birth']);
        $age = $now->diff($dob);
        return $age->y;
    }

    public function updateLocation($latitude, $longitude)
    {
        $this->attributes['latitude'] = $latitude;
        $this->attributes['longitude'] = $longitude;
        $this->save();
    }

    public function trade(Survivor $survivor)
    {
        $this->attributes['recourses'] = $value;
    }


}
