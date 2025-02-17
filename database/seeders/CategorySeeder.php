<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $income = Category::create([
            'name' => 'Income',
            'type' => 'income',
            'parent_id' => null,
            'logo' => null,
            'order' => 0,
            'description' => 'income'
        ]);
        $incomeChildren =      [
            [
                'name' => 'Salary',
                'type' => 'income',
                'parent_id' => $income->id,
                'logo' => null,
                'order' => 0,
                'description' => 'salary'
            ],
            [
                'name' => 'Commission',
                'type' => 'income',
                'parent_id' => $income->id,
                'logo' => null,
                'order' => 0,
                'description' => 'commission'
            ],
            [
                'name' => 'Interest',
                'type' => 'income',
                'parent_id' => $income->id,
                'logo' => null,
                'order' => 0,
                'description' => 'interest'
            ],
            [
                'name' => 'Bonus',
                'type' => 'income',
                'parent_id' => $income->id,
                'logo' => null,
                'order' => 0,
                'description' => 'bonus'
            ],
            [

                'name' => 'Gift',
                'type' => 'income',
                'parent_id' => $income->id,
                'logo' => null,
                'order' => 0,
                'description' => 'gift'
            ],
            [
                'name' => 'Other',
                'type' => 'income',
                'parent_id' => $income->id,
                'logo' => null,
                'order' => 0,
                'description' => 'other'
            ],

        ];

        foreach ($incomeChildren as $child) {
            Category::create($child);
        }

        $expense = Category::create([
            'name' => 'Expense',
            'type' => 'expense',
            'parent_id' => null,
            'logo' => null,
            'order' => 0,
            'description' => 'expense'
        ]);
        $expenseChildren =      [
            [
                'name' => 'Food',
                'type' => 'expense',
                'parent_id' => $expense->id,
                'logo' => null,
                'order' => 0,
                'description' => 'food'
            ],
            [
                'name' => 'Clothing',
                'type' => 'expense',
                'parent_id' => $expense->id,
                'logo' => null,
                'order' => 0,
                'description' => 'clothing'
            ],
            [
                'name' => 'Entertainment',
                'type' => 'expense',
                'parent_id' => $expense->id,
                'logo' => null,
                'order' => 0,
                'description' => 'entertainment'
            ],
            [
                'name' => 'Health',
                'type' => 'expense',
                'parent_id' => $expense->id,
                'logo' => null,
                'order' => 0,
                'description' => 'health'
            ],
            [

                'name' => 'Other',
                'type' => 'expense',
                'parent_id' => $expense->id,
                'logo' => null,
                'order' => 0,
                'description' => 'other'
            ],
        ];

        foreach ($expenseChildren as $child) {
            Category::create($child);
        }
    }
}
