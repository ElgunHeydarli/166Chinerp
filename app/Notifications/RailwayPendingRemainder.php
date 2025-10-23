<?php

namespace App\Notifications;

use App\Models\OrderItemRailwayBill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RailwayPendingRemainder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public OrderItemRailwayBill $orderItemRailwayBill)
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'order_item_id' => $this->orderItemRailwayBill->order_item_id,
            'message' => $this->orderItemRailwayBill->order_item->order->code . ' №-li sifarişin railway statusu təsdiqlənməyib',
            'status' => $this->orderItemRailwayBill->status,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
