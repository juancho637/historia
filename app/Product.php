<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int state_id
 * @property mixed id
 */
class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'value',
        'tax_percentage',
        'description',
        'type',
        'state_id',
        'category_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function providers(){
        return $this->belongsToMany(Provider::class);
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
    public function stocks(){
        return $this->hasMany(Stock::class);
    }

    /**
     * Scope a query to only include products of a given name.
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
     * Scope a query to only include users of a given occupations with abbreviation.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed $categoryAbbreviation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategoryAbbreviation($query, $categoryAbbreviation)
    {
        return $query->whereHas('category', function ($query) use ($categoryAbbreviation) {
            $query->where('abbreviation', $categoryAbbreviation);
        });
    }

    public function getNameAttribute($name){
        return ucfirst(strtolower($name));
    }

    public function setNameAttribute($name){
        $this->attributes['name'] =  strtolower($name);
    }
}
