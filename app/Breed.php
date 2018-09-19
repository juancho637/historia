<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int state_id
 */
class Breed extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'species_id',
        'state_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pets(){
        return $this->hasMany(Pet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function species(){
        return $this->belongsTo(Species::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(){
        return $this->belongsTo(State::class);
    }

    /**
     * Scope a query to only include breeds of a given species.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  $species_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfSpecies($query, $species_id)
    {
        return $query->where('species_id', $species_id);
    }
}
