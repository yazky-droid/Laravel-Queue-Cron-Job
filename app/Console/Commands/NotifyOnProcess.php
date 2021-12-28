<?php

namespace App\Console\Commands;

use App\Jobs\NotifyStatus;
use App\Models\Transaction;
use DB;
use Illuminate\Console\Command;

class NotifyOnProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notify-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command transaction paid';

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
        $transaction = Transaction::with('user')
            ->where('status', 'paid')
            ->orderBy('created_at', 'asc')
            ->first();

        $result['data'] = $transaction;

        DB::beginTransaction();
        if (!is_null($transaction)) {
            $transaction->status = 'process';
            if ($transaction->save()) {
                $details = [
                    'email' => $transaction->user->email,
                    'name' => $transaction->user->name,
                    'id_transaksi' => $transaction->id,
                    'subject' => 'Transaksi Diproses',
                    'content' => 'Selamat, transaksi anda sedang di proses.',
                ];
                $sendNotif = NotifyStatus::dispatch($details);
                if ($sendNotif) {
                    DB::commit();
                    $result['status'] = 'Job berhasil';
                } else {
                    DB::rollback();
                    $result['status'] = 'Job gagal';
                }
            }
        } else {
            $result['status'] = 'Tidak ada data';
        }
        $this->line(json_encode($result));
    }
}
