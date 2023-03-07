<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\EmployeeInformation;

class NotifyUserAndAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_id;
    public $transaction_id;
    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $transaction_id)
    {
        $this->user_id = $user_id;
        $this->transaction_id = $transaction_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::create([
            'user_id' => $this->user_id,
            'description' => 'One of your transactions is due.',
            'sender_id' => 1,
            'redirect' => 's',
        ]);

        Transaction::where('id', $this->transaction_id)
            ->first()
            ->update([
                'status' => 5,
            ]);

        $user = EmployeeInformation::where('user_id', $this->user_id)->first();
        Notification::create([
            'user_id' => 1,
            'description' =>
                $user->firstname .
                ' ' .
                $user->lastname .
                "'" .
                's transactions is due.',
            'sender_id' => 1,
            'redirect' => 's',
        ]);
    }
}
