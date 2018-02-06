<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CerrarTarea extends Mailable
{
    use Queueable, SerializesModels;

    private $proyecto;

    private $tarea;

    private $fecha_termino;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($proyecto, $tarea, $fecha_termino)
    {
        $this->proyecto = $proyecto;
        $this->tarea = $tarea;
        $this->fecha_termino = $fecha_termino;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.cerrar_tarea')
            ->with('proyecto', $this->proyecto)
            ->with('tarea', $this->tarea)
            ->with('fecha_termino', $this->fecha_termino)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Tarea Cerrada');
    }
}
