<?php

namespace App;

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
        'type',
    ];

    /**
     * Scope a query to only include paid and active subscribers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActiveAndPaid($query)
    {
        return $query->where('status', 'ACTIVE')->where('type', 'PAID');
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
