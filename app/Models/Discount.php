<?php

namespace App\Models;

use App\Http\Traits\Statistics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes, Statistics;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'value',
        'expire_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expire_at' => 'datetime',
    ];

    /**
     * declare columns to use in statistics data
     *
     * @param $rules
     * @return array
     */
    protected function statistics_columns($rules)
    {
        return [
            'expire_at' => ['expire_at' => '>=', $rules['expire_at'] ?? '0000-00-00 00:00:00'],
        ];
    }

    /**
     * Belongs to orders
     *
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
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
     * use for (12 hours ago) or (12-12-2012)
     *
     * @return false|\Morilog\Jalali\Jalalian|string
     */
    public function expire_at()
    {
        $time = $this->expire_at;

        if (!$time) {
            return false;
        }

        return jdate($time)->format('%B %d، %Y');
    }
}
