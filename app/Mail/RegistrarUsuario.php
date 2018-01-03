<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrarUsuario extends Mailable
{
    use Queueable, SerializesModels;

    private $nombre;

    private $pass;

    private $rut;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $rut, $pass)
    {
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->rut = $rut;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registrar_usuario')
            ->with('nombre', $this->nombre)
            ->with('pass', $this->pass)
            ->with('rut', $this->rut)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Registro de usuario');
    }
}
