<?php

namespace App\Console\Commands;

use App\Jobs\ExpiredStatus;
use Illuminate\Console\Command;

class ChangePaymentStatusToExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:proccess';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change payment to proccess';

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
        ExpiredStatus::dispatch();
    }
}
