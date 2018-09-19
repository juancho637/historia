<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany(User::class);
    }
}
