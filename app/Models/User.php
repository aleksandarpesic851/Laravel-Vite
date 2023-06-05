<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'country',
        'state',
        'division',
        'company',
        'matchmaker_at',
        'round',
        'phone',
        'passport',
        'visa',
        'language',
        'boxrec_id',
        'home_town',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        $url = '';
        try {
            if ($this->avatar) {
                $url = asset('storage/' . $this->avatar);
            } else {
                $url = asset('images/default_avatar.png');
            }
        } catch (Throwable $e) {
            $url = asset('images/default_avatar.png');
        }
        return $url;
    }

    public function myReviews()
    {
        return $this->hasMany('App\Models\Review', 'to', 'id');
    }

    public function myBoxers()
    {
        return $this->hasMany('App\Models\MyBoxer', 'owner_id', 'id');
    }

    // public function myManager()
    // {
    //     $owners = $this->hasMany('App\Models\MyBoxer', 'boxer_id', 'id')
    //         ->with('owner')->get();

    //     foreach ($owners as $owner) {
    //         if ($owner->owner->hasRole('Manager')) {
    //             return $owner;
    //         }
    //     }
    // }

    // public function myMtachMaker()
    // {
    //     $owners = $this->hasMany('App\Models\MyBoxer', 'boxer_id', 'id')
    //         ->with('owner')->get();

    //     foreach ($owners as $owner) {
    //         if ($owner->owner->hasRole('MatchMaker')) {
    //             return $owner;
    //         }
    //     }
    // }

    // public function myPromoter()
    // {
    //     $owners = $this->hasMany('App\Models\MyBoxer', 'boxer_id', 'id')
    //         ->with('owner')->get();

    //     foreach ($owners as $owner) {
    //         if ($owner->owner->hasRole('Promoter')) {
    //             return $owner;
    //         }
    //     }
    // }

    public function countryDetail()
    {
        return $this->belongsTo('App\Models\Country', 'country', 'id');
    }

    public function stateDetail()
    {
        return $this->belongsTo('App\Models\State', 'state', 'id');
    }

    public function divisionDetail()
    {
        return $this->belongsTo('App\Models\Division', 'division', 'id');
    }
}