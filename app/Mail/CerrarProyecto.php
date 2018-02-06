<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CerrarProyecto extends Mailable
{
    use Queueable, SerializesModels;

    private $proyecto;

    private $comentario_cierre;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proyecto, $comentario_cierre)
    {
        $this->proyecto = $proyecto;
        $this->comentario_cierre = $comentario_cierre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cerrar-proyecto')
            ->with('proyecto', $this->proyecto)
            ->with('comentario_cierre', $this->comentario_cierre)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Cierre de Proyecto');
    }
}
