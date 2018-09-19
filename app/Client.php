<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @property int state_id
 * @property mixed full_name
 * @property mixed type_identification
 * @property mixed identification
 * @property mixed email
 * @property mixed cell_phone
 * @property mixed phone
 * @property mixed address
 * @property mixed pets
 */
class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type_identification',
        'identification',
        'full_name',
        'email',
        'cell_phone',
        'phone',
        'address',
        'birth_date',
        'gender',
        'smoker',
        'junkie',
        'state_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(){
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pets(){
        return $this->belongsToMany(Pet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function engagements(){
        return $this->hasMany(Engagement::class);
    }

    /**
     * Scope a query to only include clients of a given name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $full_name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFullName($query, $full_name)
    {
        return $query->orWhere('full_name', 'LIKE', '%'.$full_name.'%');
    }

    /**
     * Scope a query to only include clients of a given identification.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $identification
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIdentification($query, $identification)
    {
        return $query->orWhere('identification', 'LIKE', '%'.$identification.'%');
    }

    /**
     * Scope a query to only include clients of a given pets with name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePetName($query, $name)
    {
        return $query->orWhereHas('pets', function ($query) use ($name) {
            $query->where('name', 'LIKE', '%'.$name.'%');
        });
    }
}
