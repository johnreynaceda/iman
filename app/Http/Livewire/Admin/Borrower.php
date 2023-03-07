<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use WireUi\Traits\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ViewColumn;

class Borrower extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public $view_modal = false;
    public $user_id;
    public function render()
    {
        return view('livewire.admin.borrower', [
            'details' => User::when($this->user_id, function ($query) {
                $query->where('id', $this->user_id);
            })->first(),
        ]);
    }

    protected function getTableQuery(): Builder
    {
        return User::query()
            ->where('is_admin', false)
            ->withCount('transactions');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('NAME')
                ->searchable()
                ->sortable(),
            TextColumn::make('email')
                ->label('EMAIL')
                ->searchable()
                ->sortable(),
            BadgeColumn::make('is_blacklisted')
                ->icon('heroicon-o-finger-print')
                ->label('STATUS')
                ->enum([
                    0 => 'Not Blacklisted',
                    1 => 'Blacklisted',
                ])
                ->colors([
                    'success' => 0,
                    'danger' => 1,
                ]),
            TextColumn::make('transactions_count')->label('TOTAL BORROWED'),
            ViewColumn::make('id')
                ->label('')
                ->view('borrower-view'),
        ];
    }
    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('is_blacklisted')
                ->label('Category Name')
                ->options([
                    '0' => 'Not Blacklisted',
                    '1' => 'Blacklisted',
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('Manage Status')
                ->label('Manage Status')
                ->color('gray')
                ->icon('heroicon-o-pencil-alt')
                ->button()
                ->action(function ($record, $data) {
                    // dd($data);
                    $record->update([
                        'is_blacklisted' => $data['is_blacklisted'],
                    ]);
                    $this->dialog()->success(
                        $title = 'Status Updated',
                        $description =
                            'The user status has been updated successfully.'
                    );
                })
                ->form(function ($record) {
                    return [
                        Select::make('is_blacklisted')
                            ->label('Set Status')
                            ->default($record->is_blacklisted)
                            ->options([
                                '0' => 'Not Blacklisted',
                                '1' => 'Blacklisted',
                            ]),
                    ];
                })
                ->modalHeading('Edit Status')
                ->modalWidth('lg'),
        ];
    }

    public function viewDetail($id)
    {
        $this->user_id = $id;
        $this->view_modal = true;
    }

    public function resetPassword()
    {
        User::where('id', $this->user_id)
            ->first()
            ->update([
                'password' => bcrypt('12345'),
            ]);

        $this->dialog()->success(
            $title = 'Password Reset',
            $description =
                'The password has been reset to 12345. Please inform the user to change the password after login.'
        );

        $this->view_modal = false;
    }
}
