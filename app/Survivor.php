<?php

namespace App;

use Validator;
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

    public static $createRules = [
        'name' => ['required','max:100'],
        'birth' => ['required','date'],
        'latitude' => ['required','numeric'],
        'longitude' => ['required','numeric'],
        'gender' => ['required'],
        'recourses' => ['present', 'array'],
        'recourses.*.amount' => ['required', 'integer', 'gte:0'],
        'recourses.*.item_id' => ['required', 'integer']
    ];

    public function recourses()
    {
        return $this->hasMany(Recourse::class);
    }

    public function setRecoursesAttribute($recourses)
    {
        foreach ($recourses as $recourse) {
            $this->recourses()->save(new Recourse($recourse));
        }
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
