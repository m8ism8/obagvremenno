<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Sale;

class SaleNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;
    
    public function __construct($sale)
    {
        $this->sale = $sale;
    }

    
    public function build()
    {
        return $this->from('obag.kz@gmail.com', 'O Bag')
                    ->subject('Новая акция!')
                    ->view('saleNotifyMail');
    }
}
