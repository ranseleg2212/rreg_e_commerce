<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationShopping extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
        ///$this->url = $url;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Detalles del Pedido',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.free-order-receipt',
        );
    }

    public function attachments()
    {
        return [];
    }
}
