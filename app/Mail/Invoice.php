<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    private $username;
    private $products;
    private $products_images;

    public function __construct($username, $products, $products_images, $shipping)
    {
        $this->username = $username;
        $this->products = $products;
        $this->products_images = $products_images;
        $this->shipping = $shipping;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invoice')->with([
            'username' => $this->username,
            'products' => $this->products,
            'products_images' => $this->products_images,
            'shipping' => $this->shipping,
            'url' => 'http://127.0.0.1:8000/order/' .$this->shipping->order_id,
        ])->subject('Pembelanjaan di Twice But Nice Berhasil (Nomor Order : #' . $this->shipping->order_id . ')');
    }
}