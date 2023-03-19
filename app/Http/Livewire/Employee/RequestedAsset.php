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

class RequestedAsset extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $view_modal = false;
    public $transaction_id;
    public function render()
    {
        return view('livewire.employee.requested-asset', [
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
            ->whereNotIn('status', [3, 4]);
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
            TextColumn::make('accountable_person')
                ->label('ACCOUNTABLE PERSON')
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
                    1 => 'Pending',
                    2 => 'Approved',
                    3 => 'Rejected',
                ])
                ->colors([
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 3,
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
                    '1' => 'Pending',
                    '2' => 'Approved',
                ]),
        ];
    }

    public function viewDetail($id)
    {
        $this->transaction_id = $id;
        $this->view_modal = true;
    }
}
