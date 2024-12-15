<?php

namespace App\Filament\Resources\BudgetResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BudgetResource;
use App\Filament\Resources\BudgetResource\Widgets\BudgetTransactionsTable;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;

class EditBudget extends EditRecord
{
    protected static string $resource = BudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('description'),
                TextInput::make('amount'),
                TextInput::make('start_date'),
                TextInput::make('end_date'),
                TextInput::make('currency'),
                TextInput::make('type'),
                TagsInput::make('categories'),
            ]);
    }
}
