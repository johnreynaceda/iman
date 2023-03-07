<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Category;
use WireUi\Traits\Actions;
use App\Models\EmployeeInformation;
use App\Models\Transaction;
use App\Models\RequestedAsset;
use DB;
use App\Models\Notification;
use App\Models\User;

class RequestForm extends Component
{
    public $get_asset = [];
    public $request_modal = false;
    use Actions;

    public $return_date, $purpose;
    public function render()
    {
        return view('livewire.employee.request-form', [
            'categories' => Category::with('assets')
                ->whereHas('assets')
                ->get(),
            'details' => EmployeeInformation::where(
                'user_id',
                auth()->user()->id
            )->first(),
        ]);
    }

    public function getAsset($category_id)
    {
        if (auth()->user()->is_blacklisted == true) {
            $this->dialog()->error(
                $title = 'Sorry',
                $description =
                    'Your account is blacklisted. Please contact the admin for more information.'
            );
        } else {
            $query = Category::where('id', $category_id)->first();
            if (count($query->assets) == 0) {
                $this->dialog()->error(
                    $title = 'Sorry',
                    $description = 'This Item has no available assets'
                );
            } else {
                foreach ($this->get_asset as $key => $item) {
                    if ($item['id'] == $query->id) {
                        $this->get_asset[$key]['qty'] += 1;
                        return;
                    }
                }
                $this->get_asset[] = [
                    'id' => $category_id,
                    'name' => $query->name,
                    'qty' => 1,
                ];
            }
        }
    }
    public function removeItem($key)
    {
        unset($this->get_asset[$key]);
    }

    public function addQty($key)
    {
        $this->get_asset[$key]['qty'] += 1;
    }

    public function minusQty($key)
    {
        if ($this->get_asset[$key]['qty'] > 1) {
            $this->get_asset[$key]['qty'] -= 1;
        } else {
            unset($this->get_asset[$key]);
        }
    }

    public function updatedRequestModal()
    {
        if ($this->get_asset == null) {
            $this->request_modal = false;
            $this->dialog()->error(
                $title = 'Sorry',
                $description = 'Please select an asset to request.'
            );
        } else {
            $this->request_modal = true;
        }
    }

    public function sendRequest()
    {
        $this->validate([
            'purpose' => 'required',
            'return_date' => 'required',
        ]);

        $code = 'RN' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

        DB::beginTransaction();
        $transaction = Transaction::create([
            'transaction_code' => $code,
            'user_id' => auth()->user()->id,
            'borrowed_date' => now(),
            'returned_date' => $this->return_date,
            'accountable_person' => auth()->user()->employeeInformation
                ->department->name,
            'purpose' => $this->purpose,
        ]);

        foreach ($this->get_asset as $key => $item) {
            RequestedAsset::create([
                'transaction_id' => $transaction->id,
                'category_id' => $item['id'],
                'quantity' => $item['qty'],
            ]);
        }

        Notification::create([
            'user_id' => User::where('is_admin', true)->first()->id,
            'sender_id' => auth()->user()->id,
            'description' =>
                auth()->user()->employeeInformation->first_name .
                ' ' .
                auth()->user()->employeeInformation->last_name .
                ' has requested an asset.',
            'redirect' => $transaction->id,
        ]);
        DB::commit();
        $this->dialog()->success(
            $title = 'Success',
            $description = 'Your request has been sent.'
        );
        $this->get_asset = [];
        $this->request_modal = false;
    }
}
