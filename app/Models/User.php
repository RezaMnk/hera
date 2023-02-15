<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\Statistics;
use App\Notifications\KavenegarNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Statistics;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'verified',
        'password',
        'admin',
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

    /**
     * declare columns to except for statistics
     *
     * @param $rules
     * @return array
     */
    protected function statistics_exceptions($rules)
    {
        return [
            'id' => 1,
        ];
    }


    /**
     * declare rules for calculation method
     *
     * @param $rules
     * @return array
     */
    protected function calc_static_rules()
    {
        return [
            'exceptions' => [
                'id' => 1
            ],
        ];
    }


    /**
     * Relation connection with Two-Factor Auth
     *
     * @return HasMany
     */
    public function twoFA()
    {
        return $this->hasMany(TwoFA::class);
    }

    /**
     * Relation connection with Order
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * User -> Has many "Maps"
     *
     * @return HasMany
     */
    public function maps()
    {
        return $this->hasMany(Map::class);
    }


    /**
     * Verify the user authentication
     *
     * @return void
     */
    public function verify()
    {
        if (! $this->verified) {

            $this->verified = true;
            $this->save();
        }
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function is_admin()
    {
        return $this->admin;
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function is_owner()
    {
        return $this->id == 1;
    }


    /**
     * Set hashed password attribute for user
     *
     * @param $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }



    /**
     * use for (12 hours ago) or (12-12-2012)
     *
     * @return false|\Morilog\Jalali\Jalalian|string
     */
    public function created_at()
    {
        $time = $this->created_at;

        if (!$time) {
            return false;
        }

        if ($time > now()->subHours(24)) {
            return jdate($time)->ago();
        }

        return jdate($time)->format('%B %d، %Y');
    }



    /**
     * send sms to the user
     *
     * @param $tokens
     * @param $template
     * @return void
     */
    public function send_sms($tokens, $template = 'verify')
    {
        $this->notify(new KavenegarNotification($tokens, $template));
    }
}
