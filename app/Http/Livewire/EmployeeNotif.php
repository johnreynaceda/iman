<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class EmployeeNotif extends Component
{
    public function render()
    {
        return view('livewire.employee-notif', [
            'notifications' => Notification::where(
                'user_id',
                auth()->user()->id
            )
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    public function openRequest($id)
    {
        $notification = Notification::where('id', $id)->first();
        $notification->update([
            'read_at' => now(),
        ]);
    }

    public function readAll()
    {
        $notifications = Notification::where(
            'user_id',
            auth()->user()->id
        )->get();
        foreach ($notifications as $notification) {
            $notification->update([
                'read_at' => now(),
            ]);
        }
    }
}
