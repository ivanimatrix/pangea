<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RechazarTarea extends Mailable
{
    use Queueable, SerializesModels;

    private $proyecto;

    private $tarea;

    private $comentario_rechazo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proyecto, $tarea, $comentario_rechazo)
    {
        $this->proyecto = $proyecto;
        $this->tarea = $tarea;
        $this->comentario_rechazo = $comentario_rechazo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.rechazar-tarea')
            ->with('proyecto', $this->proyecto)
            ->with('tarea', $this->tarea)
            ->with('comentario_rechazo', $this->comentario_rechazo)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Tarea Rechazada');
    }
}
