<?php

namespace App\Console\Commands;

use App\Jobs\ProccessStatus;
use Illuminate\Console\Command;

class ChangePaymentStatusToProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change payment status to expired';

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
        ProccessStatus::dispatch();
    }
}
