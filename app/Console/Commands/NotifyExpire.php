<?php

namespace App\Console\Commands;

use App\Jobs\NotifyStatus;
use App\Models\Transaction;
use DB;
use Illuminate\Console\Command;

class NotifyExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:notify-expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command transaction expired';

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
            ->where('expired_at', '<', date('Y-m-d H:i:s'))
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->first();

        DB::beginTransaction();
        if (!is_null($transaction)) {
            $transaction->status = 'expired';
            if ($transaction->save()) {
                $details = [
                    'email' => $transaction->user->email,
                    'name' => $transaction->user->name,
                    'id_transaksi' => $transaction->id,
                    'subject' => 'Transaksi Expired',
                    'content' => 'Transaksi anda telah kadaluwarsa. Silahkan lakukan pemesanan ulang.',
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
        $result['data'] = $transaction;
        $this->line(json_encode($result));
    }
}
