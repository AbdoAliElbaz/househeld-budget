<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
        'amount',
        'currency',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
