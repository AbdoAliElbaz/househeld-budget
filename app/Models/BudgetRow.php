<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetRow extends Model
{
    protected $table = 'budget_rows';

    protected $fillable = [
        'total',
        'budget_id',

    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'row_id');
    }
}
