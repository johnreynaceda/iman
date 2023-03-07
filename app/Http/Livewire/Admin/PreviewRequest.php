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

class PreviewRequest extends Component
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
        return view('livewire.admin.preview-request', [
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
}
