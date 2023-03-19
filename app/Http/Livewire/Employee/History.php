<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Asset as AssetModel;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Category;
use Filament\Tables\Columns\BadgeColumn;
use App\Models\Inventory;
use WireUi\Traits\Actions;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\Transaction;
use Filament\Tables\Columns\ViewColumn;

class History extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $view_modal = false;
    public $transaction_id;
    public function render()
    {
        return view('livewire.employee.history', [
            'transactions' => Transaction::when(
                $this->transaction_id,
                function ($query) {
                    $query->where('id', $this->transaction_id);
                }
            )->first(),
        ]);
    }

    protected function getTableQuery(): Builder
    {
        return Transaction::query()
            ->where('user_id', auth()->user()->id)
            ->whereIn('status', [3, 4, 5]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('transaction_code')
                ->label('TRANSACTION CODE')
                ->searchable()
                ->sortable(),
            TextColumn::make('borrowed_date')
                ->date()
                ->label('BORROWED DATE')
                ->searchable()
                ->sortable(),
            TextColumn::make('returned_date')
                ->date()
                ->label('RETURNED DATE')
                ->searchable()
                ->sortable(),

            TextColumn::make('requested_assets.item')
                ->label('REQUESTED ITEM')
                ->formatStateUsing(function ($record) {
                    return $record->requestedAssets->count() . ' Asset(s)';
                })
                ->searchable()
                ->sortable(),
            BadgeColumn::make('status')
                ->label('STATUS')
                ->enum([
                    3 => 'Rejected',
                    4 => 'Returned',
                    5 => 'Due',
                ])
                ->colors([
                    'danger' => 3,
                    'success' => 4,
                    'danger' => 5,
                ]),
            ViewColumn::make('id')
                ->label('')
                ->view('borrower-view'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('status')
                ->label('Request Status')
                ->options([
                    '3' => 'Rejected',
                    '4' => 'Returned',
                    '5' => 'Due',
                ]),
        ];
    }

    public function viewDetail($id)
    {
        $this->transaction_id = $id;
        $this->view_modal = true;
    }
}
