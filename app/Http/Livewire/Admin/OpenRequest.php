<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Asset;
use App\Models\RequestedAsset;
use App\Models\RequestTransaction;
use WireUi\Traits\Actions;
use DB;
use App\Models\Notification;
use App\Models\BorrowedAsset;
use App\Jobs\NotifyUserAndAdmin;

class OpenRequest extends Component
{
    public $transaction_id;
    public $selected_asset = [];
    public $assets_modal = false;
    public $assets = [];
    public $requested_id;
    public $selected_quanity;
    public $remarks;
    public $remarks_modal = false;
    use Actions;

    public function mount()
    {
        $this->transaction_id = request()->id;
    }
    public function render()
    {
        return view('livewire.admin.open-request', [
            'details' => Transaction::where(
                'id',
                $this->transaction_id
            )->first()->user->employeeInformation,
            'transaction' => Transaction::where(
                'id',
                $this->transaction_id
            )->first(),
        ]);
    }

    public function manageItem($id, $category_id)
    {
        $this->assets_modal = true;
        $this->assets = Asset::where('category_id', $category_id)
            ->where('status', 1)
            ->get();
        $this->selected_quanity = RequestedAsset::where(
            'id',
            $id
        )->first()->quantity;
        $this->requested_id = $id;
    }

    public function selectAsset($asset_id)
    {
        $asset = Asset::where('id', $asset_id)->first();

        if (collect($this->selected_asset)->contains('id', $asset_id)) {
            $this->dialog()->error(
                $title = 'Sorry',
                $description = 'You have already selected this asset'
            );
        } elseif (
            collect($this->selected_asset)
                ->where('category_id', $asset->category_id)
                ->count() >= $this->selected_quanity
        ) {
            $this->dialog()->error(
                $title = 'Sorry',
                $description =
                    'You have selected more than the requested quantity'
            );
        } else {
            $this->selected_asset[] = [
                'id' => $asset->id,
                'requested_asset_id' => $this->requested_id,
                'category_id' => $asset->category_id,
                'name' => $asset->name,
            ];
        }
    }

    public function removeAsset($key)
    {
        unset($this->selected_asset[$key]);
        $this->notification()->success(
            $title = 'Removed',
            $description = 'Asset was removed successfully'
        );
    }

    public function acceptRequest()
    {
        if ($this->selected_asset == []) {
            $this->dialog()->error(
                $title = 'Sorry',
                $description = 'You have not selected any asset'
            );
        } else {
            $employee = Transaction::where('id', $this->transaction_id)->first()
                ->user->id;
            $transaction = Transaction::where(
                'id',
                $this->transaction_id
            )->first();
            DB::beginTransaction();
            foreach ($this->selected_asset as $key => $item) {
                RequestTransaction::create([
                    'requested_asset_id' => $item['requested_asset_id'],
                    'asset_id' => $item['id'],
                ]);
                Asset::where('id', $item['id'])
                    ->first()
                    ->update([
                        'status' => '0',
                    ]);
                BorrowedAsset::create([
                    'asset_id' => $item['id'],
                    'user_id' => $employee,
                    'borrowed_date' => $transaction->borrowed_date,
                    'returned_date' => $transaction->returned_date,
                ]);
            }

            Transaction::where('id', $this->transaction_id)
                ->first()
                ->update([
                    'status' => '2',
                ]);

            $notif = Notification::create([
                'user_id' => $employee,
                'sender_id' => 1,
                'description' => 'Your request has been accepted.',
                'redirect' => '1',
            ]);

            NotifyUserAndAdmin::dispatch(
                $notif->user_id,
                $this->transaction_id
            )->delay(
                // \Carbon\Carbon::parse($transaction->returned_date)
                \Carbon\Carbon::now()->addMinutes(1)
            );

            DB::commit();

            $this->dialog()->success(
                $title = 'Success',
                $description = 'Request was accepted successfully'
            );
            return redirect()->route('admin.requests');
        }
    }

    public function declineRequest()
    {
        $this->remarks_modal = true;
    }

    public function doneRemark()
    {
        $this->validate([
            'remarks' => 'required',
        ]);

        $employee = Transaction::where('id', $this->transaction_id)->first()
            ->user->id;

        Transaction::where('id', $this->transaction_id)
            ->first()
            ->update([
                'status' => '3',
                'remarks' => $this->remarks,
            ]);

        Notification::create([
            'user_id' => $employee,
            'sender_id' => 1,
            'description' => 'Your request has been rejected.',
            'redirect' => '1',
        ]);

        $this->dialog()->success(
            $title = 'Success',
            $description = 'Request was declined successfully'
        );
        return redirect()->route('admin.requests');
    }
}
