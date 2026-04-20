<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderConfirmNotification extends Notification
{
    use Queueable;

    public $order;
    public $items;

    public function __construct($order, $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Xác nhận đơn hàng #' . $this->order->order_id)
            ->view('email.order_confirm', [
                'order' => $this->order,
                'items' => $this->items,
            ]);
    }
}