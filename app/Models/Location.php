<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function terms(){
        return $this->belongsToMany(Term::class, 'classroom_location_term', 'location_id', 'term_id');
    }
}
