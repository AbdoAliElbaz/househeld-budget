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
        return $this->belongsToMany(User::class)->withPivot('is_owner');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function owner()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('is_owner')
            ->wherePivot('is_owner', true)
            ->first();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function rows()
    {
        return $this->hasMany(BudgetRow::class);
    }
}
