<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use App\Mail\MailNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\MailController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class TransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $transaction,$id;
    public function __construct($id,$transaction)
    {
        $this->transaction = $transaction;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // MailController::invoice($this->id);
        $transaction = Transaction::find($this->transaction);
        if($transaction->status == 'created'){
            Transaction::find($this->transaction)->update([
                'status'=>'failed'
            ]);
            $email = User::find($this->id)->email;
            Mail::to($email)->send(new MailNotification('invoice',$email));
            return 'email sended';
        }
    }
}
