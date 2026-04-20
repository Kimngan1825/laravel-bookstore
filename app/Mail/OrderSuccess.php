<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;
    public $cart;
    public $subtotal;

    /**
     * Create a new message instance.
     *
     * @param int|string $orderId
     * @param array $cart
     */
    public function __construct($orderId, array $cart)
    {
        $this->orderId = $orderId;
        $this->cart = $cart;
        $this->subtotal = 0;

        foreach ($cart as $item) {
            $price = (float)($item['gia_ban'] ?? 0);
            $qty = (int)($item['so_luong'] ?? 0);
            $this->subtotal += $price * $qty;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order confirmation #' . $this->orderId)
            ->view('emails.order_success');
    }
}