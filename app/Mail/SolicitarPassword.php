<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SolicitarPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $nombre;

    /** @var string */
    private $pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $pass)
    {
        $this->nombre = $nombre;
        $this->pass = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.solicitar_pass')
            ->with('nombre', $this->nombre)
            ->with('pass', $this->pass)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Nueva password');
    }
}
