<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category as CategoryModel;
use Filament\Tables\Columns\TextColumn;
use WireUi\Traits\Actions;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;

class Category extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;
    public $name;
    public function render()
    {
        return view('livewire.admin.category');
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required',
        ]);

        CategoryModel::create([
            'name' => $this->name,
        ]);

        $this->name = '';
        $this->notification()->success(
            $title = 'Category saved',
            $description = 'Category was successfully saved'
        );
    }

    protected function getTableQuery(): Builder
    {
        return CategoryModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('NAME')
                ->searchable()
                ->sortable(),
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
                        Grid::make(1)->schema([
                            TextInput::make('name')
                                ->default($record->name)
                                ->rules(
                                    'required|unique:categories,name,' .
                                        $record->id
                                ),
                        ]),
                    ];
                })
                ->modalHeading('Update Category')
                ->modalWidth('lg'),
        ];
    }
}
