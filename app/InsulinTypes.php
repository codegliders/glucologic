<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Glucotest;


class InsulinTypes extends Model
{/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','code','description_it','description_en'];
    
    /**
     * Get the user that owns the test.
     */
    public function user()
    {
        return $this->belongsTo(Glucotest::class);
    }
    
    
}
