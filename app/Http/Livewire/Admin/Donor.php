<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Donor as donorModel;
use Filament\Tables\Columns\TextColumn;
use WireUi\Traits\Actions;

class Donor extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;
    public $add_donor = false;
    public $fullname;

    protected function getTableQuery(): Builder
    {
        return donorModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('fullname')
                ->label('FULLNAME')
                ->searchable()
                ->sortable(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.donor');
    }

    public function addDonor()
    {
        $this->validate([
            'fullname' => 'required',
        ]);
        donorModel::create([
            'fullname' => $this->fullname,
        ]);

        $this->notification()->success(
            $title = 'Donor Added',
            $description = 'Donor has been added successfully'
        );
        $this->add_donor = false;
    }
}
