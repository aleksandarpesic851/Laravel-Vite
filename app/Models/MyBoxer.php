<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class MyBoxer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'boxer_id',
        'active'
    ];

    public function owner()
    {
        return $this->hasOne('App\Model\User', 'id', 'owner_id');
    }

    public function boxer()
    {
        return $this->hasOne('App\Models\User', 'id', 'boxer_id');
    }
}