<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed id
 * @property int state_id
 * @property mixed password_change
 * @property mixed name
 * @property mixed last_name
 * @property mixed full_name
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identification',
        'name',
        'last_name',
        'full_name',
        'occupation_id',
        'professional_identification',
        'address',
        'cell_phone',
        'phone',
        'email',
        'password_change',
        'password',
        'state_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(){
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function occupation(){
        return $this->belongsTo(Occupation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(){
        return $this->belongsToMany(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function detailEngagements(){
        return $this->belongsToMany(DetailEngagement::class);
    }

    /**
     * Scope a query to only include user's of a given name.
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
     * Scope a query to only include user's of a given name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $occupations
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfOccupation($query, $occupations)
    {
        return $query->whereIn('occupation_id', $occupations);
    }

    /**
     * Scope a query to only include users of a given occupations with abbreviation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $occupationAbbreviation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOccupationAbbreviation($query, $occupationAbbreviation)
    {
        return $query->orWhereHas('occupations', function ($query) use ($occupationAbbreviation) {
            $query->whereIn('abbreviation', $occupationAbbreviation);
        });
    }

    /**
     * Scope a query to only include users of a given services with abbreviation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $serviceAbbreviation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeServiceAbbreviation($query, $serviceAbbreviation)
    {
        return $query->orWhereHas('services', function ($query) use ($serviceAbbreviation) {
            $query->whereIn('abbreviation', $serviceAbbreviation);
        });
    }
}
