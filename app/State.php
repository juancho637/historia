<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
        'description',
        'abbreviation',
        'type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function engagements(){
        return $this->hasMany(Engagement::class);
    }
}
