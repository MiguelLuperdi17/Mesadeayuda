<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Variable para almacenar datos dinámicos

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('mail.test')
        ->subject($this->data['subject'])
        ->with('data', $this->data)
        ->cc('mesadeayuda@agroindustriallaredo.com')
        ->from('mesadeayuda@agroindustriallaredo.com', 'Mesa de Ayuda - Laredo');
        //return $this->view('mail.test')
        //    ->subject($this->data['subject'])
        //    ->with('data', $this->data)
        //    ->from('miguel.luperdi@agroindustriallaredo.com', 'Mesa de Ayuda - Prueba')
        //    ->to('miguel.luperdi@agroindustriallaredo.com')->to($this->data['correo']); // Cambia el correo de destino
    }

}
