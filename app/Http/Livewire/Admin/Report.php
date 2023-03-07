<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\ReturnAsset;
use App\Models\Asset;
use App\Models\User;
class Report extends Component
{
    public $report_modal = false;
    public $type;
    public $start_date, $end_date;
    public function render()
    {
        return view('livewire.admin.report', [
            'damages' => ReturnAsset::whereIn('status', [4, 5])
                ->when($this->start_date, function ($query) {
                    $query->where('created_at', '>=', $this->start_date);
                })
                ->when($this->end_date, function ($query) {
                    $query->where('created_at', '<=', $this->end_date);
                })
                ->get(),
            'borrowed' => Asset::withCount('borrowedAssets')
                ->having('borrowed_assets_count', '>', 0)
                ->get(),
            'leasts' => Asset::withCount('requestTransactions')
                ->having('request_transactions_count', '<', 3)
                ->get(),
            'unreturned' => Asset::where('status', '!=', 1)->get(),
            'losts' => ReturnAsset::where('status', 6)
                ->when($this->start_date, function ($query) {
                    $query->where('created_at', '>=', $this->start_date);
                })
                ->when($this->end_date, function ($query) {
                    $query->where('created_at', '<=', $this->end_date);
                })
                ->get(),
            'blacklisted' => User::where('is_blacklisted', 1)->get(),
        ]);
    }

    public function openReportModal($id)
    {
        $this->type = $id;
        $this->report_modal = true;
    }
}
