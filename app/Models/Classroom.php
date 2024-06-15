<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Classroom extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function lesson()
    {
        return $this->belongsTo(lesson::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function time_period()
    {
        return $this->belongsTo(TimePeriod::class);
    }

    public function educational_group()
    {
        return $this->belongsTo(EducationalGroup::class, 'eg_id');
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class, 'classroom_location_term', 'classroom_id', 'location_id');
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class, 'classroom_location_term', 'classroom_id', 'term_id');
    }
}
