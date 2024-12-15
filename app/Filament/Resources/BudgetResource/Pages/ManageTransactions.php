<?php

namespace App\Filament\Resources\BudgetResource\Pages;

use Carbon\Carbon;
use Filament\Tables;
use App\Models\Category;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BudgetResource;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ManageTransactions extends Page implements HasTable
{
    use InteractsWithTable;
    use InteractsWithRecord;
    protected static string $resource = BudgetResource::class;

    protected static string $view = 'filament.resources.budget-resource.pages.manage-transactions';




    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function table(Table $table): Table
    {
        $categories = Category::where('type', 'expense')->get();
        return $table
            ->query(
                fn() =>  $this->record->rows()
            )

            ->columns(
                array_merge(
                    [
                        Tables\Columns\TextColumn::make('created_at')->date('Y-m-d')->label('Date'),

                    ],
                    $categories->map(function ($category) {
                        return Tables\Columns\TextInputColumn::make('transactions' . '.' . $category->id)
                            ->label($category->name)
                            ->placeholder('Enter transaction amount')
                            ->rules(['numeric', 'min:0'])
                            ->state(function ($record) use ($category) {
                                $transaction = $this->record->transactions()
                                    ->where('category_id', $category->id)
                                    ->where('type', 'expense')
                                    ->where('row_id', $record->id)
                                    ->first();
                                return $transaction->amount ?? 0;
                            })
                            ->beforeStateUpdated(function ($state, $record) use ($category) {
                                $this->saveTransaction($category, $state, $record);
                            })
                        ;
                    })->toArray()
                )
            );
    }

    protected function saveTransaction($category, $amount, $row)
    {
        $transaction = $this->record->transactions()
            ->where('category_id', $category->id)
            ->where('type', 'expense')
            ->where('row_id', $row->id)
            ->first();
        if ($transaction) {
            $transaction->update([
                'amount' => $amount,
                'date' => now(),
                'user_id' => auth('web')->user()->id,
                'description' => '',
                'is_recurring' => false,
            ]);
        } else {
            $this->record->transactions()->create([
                'row_id' => $row->id,
                'budget_id' => $this->record->id,
                'category_id' => $category->id,
                'amount' => $amount,
                'date' => now(),
                'user_id' => auth('web')->user()->id,
                'type' => 'expense',
                'description' => '',
                'is_recurring' => false,
            ]);
        }
    }


    public function getHeaderActions(): array
    {
        return [
            Action::make('Add Transaction')
                ->label('Add Transaction')
                ->icon('heroicon-o-plus')
                ->action('addNewRow'),

        ];
    }

    public function addNewRow()
    {
        $this->record->rows()->create([
            'total' => 0
        ]);
    }
}
