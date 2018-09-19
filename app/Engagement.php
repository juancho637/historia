<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property void start_time
 * @property int state_id
 * @property mixed deleted_reason
 */
class Engagement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pet_id',
        'client_id',
        'user_id',
        'state_id',
        'date',
        'home_service',
        'home_service_shift',
        'home_service_consecutive',
        'engagement_to_be_confirmed',
        'deleted_reason',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailEngagements(){
        return $this->hasMany(DetailEngagement::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pet(){
        return $this->belongsTo(Pet::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(){
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(){
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users(){
        return $this->hasManyThrough(User::class, DetailEngagement::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function purchaseOrder(){
        return $this->hasOne(PurchaseOrder::class);
    }

    /**
     * Scope a query to only include appointments of a given date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param $start
     * @param $end
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByBetweenDates($query, $start, $end)
    {
        return $query->whereBetween('date', [$start, $end]);
    }

    /**
     * Scope a query to only include appointments of a given client.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  $client
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByClient($query, $client)
    {
        if($client){
            return $query->whereHas('client', function ($query) use ($client) {
                $query->where('full_name', 'LIKE', '%'.$client.'%')
                    ->orWhere('identification', 'LIKE', '%'.$client.'%');
            })->orWhereHas('pet', function ($query) use ($client) {
                $query->where('name', 'LIKE', '%'.$client.'%');
            });
        }
    }

    /**
     * Scope a query to only include appointments of a given service.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  $service_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByService($query, $service_id)
    {
        if($service_id){
            if($service_id === 'homeService'){
                return $query->where('home_service', true);
            }

            return $query->whereHas('detailEngagements', function ($query) use ($service_id) {
                $query->where('service_id', $service_id);
            });
        }
    }

    /**
     * Scope a query to only include appointments of a given user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  $user_id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, $user_id)
    {
        if($user_id){
            return $query->whereHas('detailEngagements', function ($query) use ($user_id) {
                $query->whereHas('users', function ($query) use ($user_id) {
                    $query->where('id', $user_id);
                });
            });
        }
    }
}
