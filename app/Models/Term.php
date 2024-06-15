<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];


    public function classrooms(){
        return $this->belongsToMany(Classroom::class, 'classroom_location_term', 'term_id', 'classroom_id');
    }

    public function locations(){
        return $this->belongsToMany(Location::class, 'classroom_location_term', 'term_id', 'location_id');
    }
}