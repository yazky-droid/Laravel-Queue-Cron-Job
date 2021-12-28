<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Mail\SendExpiredEmail;
use Illuminate\Console\Command;
use App\Jobs\SendNotificationJob;
use Illuminate\Support\Facades\Mail;

class ExpiredNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Expired Transaction Notification';

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
        //get transcation expired
        $userExpired = Transaction::with('user')->where('expired_at', '<', date('Y-m-d H:i:s'))->where('status', 'pending')->get();

        if (!empty($userExpired)) {

            $expired = Transaction::where('expired_at', '<', date('Y-m-d H:i:s'))->where('status', 'pending')->update(['status' => 'expired']);

            foreach ($userExpired as $user) {
                $details['email'] = $user->user->email;
                dispatch(new SendNotificationJob($details['email']));
            }

            // $this->info('Successfully sent.');
        }
    }
}
