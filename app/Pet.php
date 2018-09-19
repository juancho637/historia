<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int state_id
 */
class Pet extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'weight',
        'birth_date',
        'gender',
        'reproductive_status',
        'date_death',
        'description_death',
        'breed_id',
        'state_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        //'birth_date',
        //'date_death',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function clients(){
        return $this->belongsToMany(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function breed(){
        return $this->belongsTo(Breed::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(){
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function engagements(){
        return $this->hasMany(Engagement::class);
    }

    /**
     * Scope a query to only include pets of a given name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query, $name)
    {
        return $query->orWhere('name', 'LIKE', '%'.$name.'%');
    }

    /**
     * Scope a query to only include pets of a given client.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  $client_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfClient($query, $client_id)
    {
        return $query->whereHas('pets');
    }
}
