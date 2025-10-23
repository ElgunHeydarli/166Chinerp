<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CBMWeightNotification extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
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
            'order_id' => $this->order->id,
            'message' => $this->order->code . ' №-lu yükün çəkisinin həcminə nisbəti 320-dən yuxarıdır.',
            'ration' => $this->order->weight / $this->order->cbm,
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
