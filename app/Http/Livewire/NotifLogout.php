<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class NotifLogout extends Component
{
    public $logout_modal = false;

    public function render()
    {
        return view('livewire.notif-logout', [
            'notifications' => Notification::where(
                'user_id',
                auth()->user()->id
            )
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }

    public function openRequest($id, $redirect)
    {
        Notification::where('id', $id)->update([
            'read_at' => now(),
        ]);

        return redirect()->route('admin.open-request', ['id' => $redirect]);
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
