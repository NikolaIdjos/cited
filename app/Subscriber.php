<?php

namespace App;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'status',
    ];

    /**
     * Scope a query to only include active subscribers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', Constant::ACTIVE_STATUS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function quotes()
    {
        return $this->belongsToMany(Quote::class, 'subscriber_quote', 'subscriber_id', 'quote_id')->withTimestamps()->orderBy('pivot_created_at', 'desc')->take(1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function lastQuote()
    {
        return $this->belongsToMany(Quote::class, 'subscriber_quote', 'subscriber_id', 'quote_id')
            ->withTimestamps()
            ->orderBy('pivot_created_at', 'desc')
            ->take(1);
    }
}
