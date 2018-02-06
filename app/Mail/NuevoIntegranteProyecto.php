<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuevoIntegranteProyecto extends Mailable
{
    use Queueable, SerializesModels;

    private $nombre;

    private $proyecto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $proyecto)
    {
        $this->nombre = $nombre;
        $this->proyecto = $proyecto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.nuevo-integrante-proyecto')
            ->with('nombre', $this->nombre)
            ->with('proyecto', $this->proyecto)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Integración a Proyecto');
    }
}
