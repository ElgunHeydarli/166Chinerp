<?php

namespace App\Console\Commands;

use App\Models\OrderItemRailwayBill;
use App\Notifications\RailwayPendingRemainder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotifyPendingRailways extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify-pending-railway';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users to accepting railways status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $twelveHoursAgo = Carbon::now()->subHours(12);
        $today = Carbon::today();


        $order_item_railway_bills = OrderItemRailwayBill::where('status', 0)
            ->orderBy('created_at', 'desc')
            ->where('created_at', '<=', $twelveHoursAgo)
            ->where(function ($query) use ($today) {
                return $query
                    ->whereNull('notified_at')
                    ->orWhereDate('notified_at', '<', $today);
            })
            ->get();

        foreach ($order_item_railway_bills as $order_item_railway_bill) {
            $user = $order_item_railway_bill->order_item->order->user;
            $user->notify(new RailwayPendingRemainder($order_item_railway_bill));
            $order_item_railway_bill->notified_at = now();
            $order_item_railway_bill->save();
        }

        $this->info("Reminder notifications sent.");
    }
}
