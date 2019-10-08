<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class, 'subscriber_quote', 'quote_id', 'subscriber_id');
    }
}
