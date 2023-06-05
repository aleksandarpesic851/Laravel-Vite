<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country',
        'state',
        'slots',
        'event_name',
        'link',
        'date',
        'created_by'
    ];

    public function countryDetail()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country');
    }

    public function stateDetail()
    {
        return $this->hasOne('App\Models\State', 'id', 'state');
    }

    public function createrDetail()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }
}