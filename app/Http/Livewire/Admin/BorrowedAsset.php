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
use App\Models\Transaction;
use App\Models\RequestTransaction;
use DB;
use App\Models\ReturnAsset;
use App\Models\RequestedAsset;

class BorrowedAsset extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public $view_modal = false;
    public $details;
    public $requests;
    public $requestedTransaction;
    public $new_remarks = [];
    public $damage_remarks = [];
    public $transaction_id;
    public $return_modal = false;
    public $requested_asset = [];

    public function render()
    {
        return view('livewire.admin.borrowed-asset', [
            'assets' => AssetModel::when($this->requestedTransaction, function (
                $query
            ) {
                $query->whereIn('id', $this->requestedTransaction);
            })->get(),
        ]);
    }

    protected function getTableQuery(): Builder
    {
        return Transaction::query()->where('status', '!=', 1);
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
            TextColumn::make('user_id')
                ->label('FULLNAME')
                ->formatStateUsing(function ($record) {
                    return $record->user->employeeInformation->firstname .
                        ' ' .
                        $record->user->employeeInformation->lastname;
                })
                ->searchable()
                ->sortable(),

            TextColumn::make('user_id')
                ->label('PHONE NUMBER')
                ->formatStateUsing(function ($record) {
                    return $record->user->employeeInformation->contact;
                })
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
                    4 => 'Returned',
                    5 => 'Due',
                ])
                ->colors([
                    'warning' => 1,
                    'success' => 2,
                    'danger' => 3,
                    'primary' => 4,
                    'danger' => 5,
                ]),
            ViewColumn::make('id')
                ->label('ACTIONS')
                ->view('custom-column'),
        ];
    }

    public function viewRecord($id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $this->transaction_id = $id;
        switch ($transaction->status) {
            case 2:
                $this->view_modal = true;
                $this->details = $transaction;
                $this->requests = $transaction->requestedAssets
                    ->pluck('id')
                    ->toArray();
                $this->requestedTransaction = RequestTransaction::whereIn(
                    'requested_asset_id',
                    $this->requests
                )
                    ->pluck('asset_id')
                    ->toArray();
                break;

            case 3:
                $this->dialog()->info(
                    $title = 'Request Rejected',
                    $description = 'Request has been rejected by the admin'
                );

                break;
            case 4:
                $this->dialog()->info(
                    $title = 'Request Return',
                    $description = 'Request has already been returned'
                );
                break;
            case 5:
                $this->dialog()->error(
                    $title = 'Request Due',
                    $description = 'This request has already been due'
                );
                break;

            default:
                # code...
                break;
        }
    }

    public function returnAsset()
    {
        $assets = AssetModel::whereIn('id', $this->requestedTransaction)->get();
        $borrower = Transaction::where('id', $this->transaction_id)->first()
            ->user_id;

        DB::beginTransaction();

        foreach ($assets as $asset) {
            if (
                $this->new_remarks[$asset->id] == 4 ||
                $this->new_remarks[$asset->id] == 5 ||
                $this->new_remarks[$asset->id] == 6
            ) {
                $asset->update([
                    'remarks' => $this->new_remarks[$asset->id],
                    'reason' => $this->damage_remarks[$asset->id],
                    'status' => 1,
                ]);
                returnAsset::create([
                    'asset_id' => $asset->id,
                    'status' => $this->new_remarks[$asset->id],
                    'user_id' => $borrower,
                ]);
            } else {
                $asset->update([
                    'remarks' => $this->new_remarks[$asset->id],
                    'status' => 1,
                ]);
                returnAsset::create([
                    'asset_id' => $asset->id,
                    'status' => $this->new_remarks[$asset->id],
                    'user_id' => $borrower,
                ]);
            }
        }
        Transaction::where('id', $this->transaction_id)
            ->first()
            ->update([
                'status' => 4,
            ]);
        DB::commit();

        $this->view_modal = false;
        $this->dialog()->success(
            $title = 'Asset Returned',
            $description = 'Asset has been returned successfully'
        );
    }

    public function openReturnModal($id)
    {
        $this->return_modal = true;

        $asset = RequestedAsset::where('transaction_id', $id)->first()->id;
        $this->transaction_id = $id;
        $assets = RequestTransaction::where(
            'requested_asset_id',
            $asset
        )->get();
        $this->requested_asset = $assets;
    }

    public function returnAssets($transaction_id)
    {
        $asset = RequestedAsset::where(
            'transaction_id',
            $transaction_id
        )->first()->id;

        $assets = RequestTransaction::where('requested_asset_id', $asset)
            ->pluck('asset_id')
            ->toArray();
        DB::beginTransaction();
        $updated = AssetModel::whereIn('id', $assets)->get();

        foreach ($updated as $asset) {
            $asset->update([
                'remarks' => $this->new_remarks[$asset->id],
                'status' => 1,
            ]);
        }
        $this->return_modal = false;
        $this->dialog()->success(
            $title = 'Asset Returned',
            $description = 'Asset has been returned successfully'
        );

        Transaction::where('id', $transaction_id)
            ->first()
            ->update([
                'status' => 4,
            ]);
        DB::commit();
    }
}
