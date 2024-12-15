<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'budget_id',
        'row_id',
        'category_id',
        'description',
        'amount',
        'date',
        'type',
        'is_recurring',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getAmountAttribute($value)
    {
        return number_format($value, 2);
    }
}
