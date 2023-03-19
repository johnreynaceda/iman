<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Forms;
use Filament\Tables;
// use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Asset as AssetModel;
// use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Category;
use Filament\Tables\Columns\BadgeColumn;
use App\Models\Inventory;
use WireUi\Traits\Actions;
// use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use App\Models\Transaction;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Actions\Action;

class Requests extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $open_modal = false;
    public $preview_modal = false;

    public function render()
    {
        return view('livewire.admin.requests');
    }

    protected function getTableQuery(): Builder
    {
        return Transaction::query()->orderBy('status', 'asc');
    }

    protected function getTableContentGrid(): ?array
    {
        return [
            'md' => 2,
            'xl' => 5,
        ];
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('transaction_code')
                ->searchable()
                ->weight('bold')
                ->color('success'),
            View::make('request-table'),
        ];
    }

    public function openRequest($transaction_id)
    {
        $transaction = Transaction::where('id', $transaction_id)->first();
        switch ($transaction->status) {
            case 1:
                return redirect()->route('admin.open-request', [
                    'id' => $transaction_id,
                ]);
                break;

            case 2:
                $this->dialog()->info(
                    $title = 'Sorry',
                    $description =
                        'You are not allowed to open this request because it has been already approved.'
                );
                break;

            case 3:
                $this->dialog()->info(
                    $title = 'Sorry',
                    $description =
                        'You are not allowed to open this request because it has been already rejected.'
                );
                break;

            case 4:
                $this->dialog()->info(
                    $title = 'Sorry',
                    $description =
                        'You are not allowed to open this request because it has already returned.'
                );
                break;
            default:
                break;
        }
    }

    public function openPreview($id)
    {
        return redirect()->route('admin.preview-request', [
            'id' => $id,
        ]);
    }
}
