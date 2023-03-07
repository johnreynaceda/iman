<?php

namespace App\Http\Livewire\Admin;

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
use Filament\Tables\Columns\ViewColumn;

class Ledger extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $view_modal = false;
    public $asset_id;
    public function render()
    {
        return view('livewire.admin.ledger', [
            'assets' => AssetModel::when($this->asset_id, function ($query) {
                $query->where('id', $this->asset_id);
            })->first()->requestTransactions,
        ]);
    }

    protected function getTableQuery(): Builder
    {
        return AssetModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('inventory.inventory_code')
                ->label('INVENTORY CODE')
                ->searchable()
                ->sortable(),
            TextColumn::make('name')
                ->label('NAME')
                ->words(2)
                ->tooltip(fn(AssetModel $record): string => " {$record->name}")
                ->searchable()
                ->sortable(),
            TextColumn::make('serial_number')
                ->label('SERIAL NUMBER')
                ->words(2)
                ->tooltip(
                    fn(
                        AssetModel $record
                    ): string => " {$record->serial_number}"
                )
                ->searchable()
                ->sortable(),
            ViewColumn::make('id')
                ->label('BORROWERS')
                ->view('ledger-column'),
        ];
    }

    public function viewBorrower($id)
    {
        $this->asset_id = $id;
        $this->view_modal = true;
    }
}
