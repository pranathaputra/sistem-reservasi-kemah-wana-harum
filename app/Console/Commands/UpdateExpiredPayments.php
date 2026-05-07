<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Pemesanan;
use Carbon\Carbon;

class UpdateExpiredPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Pemesanan::where('status_pembayaran', 'pending')
            ->where('expired_at', '<', Carbon::now())
            ->update([
                'status_pembayaran' => 'expired'
            ]);

        return 0;
    }
}
