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
use App\Models\Donor;
class Asset extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;
    public $manage_modal = false;
    public $add_modal = false;
    public $donor_modal = false;

    public $name,
        $price,
        $description,
        $serial_number,
        $category,
        $remarks,
        $is_bundle,
        $donor,
        $quantity;

    public function render()
    {
        return view('livewire.admin.asset', [
            'categories' => Category::all(),
            'donors' => Donor::all(),
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
            TextColumn::make('description')
                ->words(5)
                ->label('DESCRIPTION')
                ->tooltip(
                    fn(AssetModel $record): string => " {$record->description}"
                )
                ->searchable()
                ->sortable(),
            BadgeColumn::make('status')
                ->enum([
                    0 => 'Not Available',
                    1 => 'Available',
                ])
                ->colors([
                    'danger' => 0,
                    'success' => 1,
                ])
                ->icon('heroicon-o-status-online'),
            TextColumn::make('price')
                ->label('PRICE')
                ->formatStateUsing(function ($record) {
                    return '₱' . number_format($record->price, 2);
                })
                ->sortable(),
        ];
    }
    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('category_id')
                ->label('Category Name')
                ->options(Category::pluck('name', 'id')),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make('category.edit')
                ->icon('heroicon-o-pencil-alt')
                ->color('success')
                ->action(function ($record, $data) {
                    $record->update($data);
                    $this->dialog()->success(
                        $title = 'Update Successfully',
                        $description =
                            'Extension rate has been updated successfully'
                    );
                })
                ->form(function ($record) {
                    return [
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->default($record->name)
                                ->rules(
                                    'required|unique:assets,name,' . $record->id
                                ),
                            TextInput::make('price')->default($record->price),
                        ]),
                        Textarea::make('description')->default($record->price),
                        Grid::make(2)->schema([
                            TextInput::make('serial_number')
                                ->default($record->serial_number)
                                ->rules(
                                    'required|unique:assets,serial_number,' .
                                        $record->id
                                ),
                            Select::make('category_id')
                                ->label('Category')
                                ->options(Category::pluck('name', 'id'))
                                ->default($record->id),
                            Select::make('donor_id')
                                ->label('Donor')
                                ->options(Donor::pluck('fullname', 'id'))
                                ->default($record->id),
                            Select::make('remarks')
                                ->label('Remarks')
                                ->options([
                                    '1' => 'Brand New',
                                    '2' => 'Functional',
                                    '3' => 'Unfunctional',
                                    '4' => 'Slightly Damaged',
                                    '5' => 'Damage',
                                    '6' => 'Lost',
                                ])
                                ->default($record->remarks),
                        ]),
                    ];
                })
                ->modalHeading('Update Asset')
                ->modalWidth('xl'),
        ];
    }

    public function addAsset()
    {
        $alpha = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
        ];

        $this->validate([
            'name' => 'required|unique:assets,name',
            'category' => 'required',
            'price' => 'required|integer|regex:/^\d+$/',
            'description' => 'required',
            'remarks' => 'required',
            'serial_number' => 'required|unique:assets,serial_number',
        ]);

        $query = AssetModel::where('category_id', $this->category)->count();

        $query += 1;
        $cat = $this->category - 1;
        $inventory_code =
            'IMAN-' . $alpha[$cat] . str_pad($query, 3, '0', STR_PAD_LEFT);

        if ($this->is_bundle == true) {
            $this->validate([
                'quantity' => 'required',
            ]);

            $asset = AssetModel::create([
                'name' => $this->name,
                'category_id' => $this->category,
                'description' => $this->description,
                'remarks' => $this->remarks,
                'price' => $this->price,
                'serial_number' => $this->serial_number,
                'donor_id' => $this->donor == null ? null : $this->donor,
                'reason' => $this->remarks,
            ]);

            Inventory::create([
                'asset_id' => $asset->id,
                'quantity' => $this->quantity,
                'inventory_code' => $inventory_code,
                'is_bundle' => true,
            ]);

            $this->reset([
                'name',
                'category',
                'description',
                'quantity',
                'remarks',
                'remarks',
                'price',
                'serial_number',
                'donor',
            ]);

            $this->notification()->success(
                $title = 'Success',
                $description = 'Asset was successfull saved'
            );

            $this->add_modal = false;
        } else {
            $asset = AssetModel::create([
                'name' => $this->name,
                'category_id' => $this->category,
                'description' => $this->description,
                'remarks' => $this->remarks,
                'price' => $this->price,
                'donor_id' => $this->donor == null ? null : $this->donor,
                'serial_number' => $this->serial_number,
            ]);

            Inventory::create([
                'asset_id' => $asset->id,
                'inventory_code' => $inventory_code,
                'is_bundle' => false,
            ]);

            $this->reset([
                'name',
                'category',
                'description',
                'quantity',
                'remarks',
                'price',
                'serial_number',
                'donor',
            ]);

            $this->notification()->success(
                $title = 'Success',
                $description = 'Asset was successfull saved'
            );

            $this->add_modal = false;
        }
    }
}
