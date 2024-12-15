<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Budget;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::find(1);
        $budget = Budget::create([
            'name' => 'Personal',
            'description' => 'Personal budget',
            'type' => 'personal',
            'currency' => 'USD',
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->endOfMonth(),
            'is_active' => true,
            'created_by' => 1,
            'amount' => 0
        ]);
        $budget->users()->attach($owner->id, ['is_owner' => true]);
        $budget->categories()->attach(
            Category::where('type', 'expense')->get()->pluck('id')->toArray()
        );
    }
}
