<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CartHold;
use Carbon\Carbon;

class CleanExpiredCartHolds extends Command
{
    protected $signature = 'cart:clean-expired-holds';
    protected $description = 'Xóa các bản ghi CartHold đã hết hạn';

    public function handle()
    {
        $deleted = CartHold::where('expires_at', '<=', now())->delete();
        $this->info("Đã xóa $deleted bản ghi CartHold hết hạn.");
    }
}
