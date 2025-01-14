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
    protected $guarded = ['recourses', 'reporteds'];
    protected $attributes = ['infected' => 0, 'birth' => '2019-01-01'];

    public static $updateRules = [
        'name' => ['required','max:100'],
        'birth' => ['required','date'],
        'latitude' => ['required','numeric'],
        'longitude' => ['required','numeric'],
        'gender' => ['required'],
    ];

    public static function updateRules(){
        return self::$updateRules;
    }

    public static function createRules()
    {
        return array_merge(
            self::$updateRules, [
                'recourses' => ['present', 'array'],
                'recourses.*.amount' => ['required', 'integer', 'gte:0'],
                'recourses.*.item_id' => ['required', 'integer']
            ]);
    }

    public function recourses()
    {
        return $this->hasMany(Recourse::class);
    }

    public function reporteds(){
        return $this->belongsToMany(Survivor::class, 'survivor_infected', 'report_id', 'reported_id');
    }

    public function getLocationAttribute()
    {
        return ['latitude' => $this->attributes['latitude'], 'longitude' => $this->attributes['longitude']];
    }

    public function getIsInfectedAttribute()
    {
        return $this->reporteds->count() >= 3;
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
