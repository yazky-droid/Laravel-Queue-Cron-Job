<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;
use App\Jobs\SendPaidNotification;

class PaidNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:paid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Paid Transaction Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get paid transaction
        $paid = Transaction::with('user')->where('status', 'paid')->get();

        if (!is_null($paid)) {
            $process = Transaction::where('status', 'paid')->update(['status' => 'process']);
            foreach ($paid as $paidUser) {
                $details['email'] = $paidUser->user->email;
                dispatch(new SendPaidNotification($details['email']));
            }

            $this->info('Successfully sent.');
        }
    }
}
