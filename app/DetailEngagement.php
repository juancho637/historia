<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailEngagement extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'engagement_id',
        'service_id',
        'state_id',
        'start_time',
        'end_time',
        'description',
        'consultation_without_cost',
        'assigned_shift',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(){
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function engagement(){
        return $this->belongsTo(Engagement::class);
    }

    public function setStartTimeAttribute($start_time){
        if($start_time){
            $this->attributes['start_time'] = date("G:i", strtotime($start_time));
        }
    }

    public function setEndTimeAttribute($end_time){
        if($end_time){
            $this->attributes['end_time'] = date("G:i", strtotime($end_time));
        }
    }

    public function getStartTimeAttribute($start_time){
        if($start_time) {
            return date("h:i a", strtotime($start_time));
        }else{
            return null;
        }
    }

    public function getEndTimeAttribute($end_time){
        if($end_time) {
            return date("h:i a", strtotime($end_time));
        }else{
            return null;
        }
    }

    public static function convertTime($time,$f) {
        if (gettype($time)=='string')
            $time = strtotime($time);

        return ($f==24) ? date("G:i", $time) : date("g:i a", strtotime($time));
    }
}
