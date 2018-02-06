<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AsignacionTarea extends Mailable
{
    use Queueable, SerializesModels;

    private $nombre;

    private $proyecto;

    private $tarea;

    private $fecha_inicio;

    private $dias;

    private $prioridad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $proyecto, $tarea, $fecha_inicio, $dias, $prioridad)
    {
        $this->nombre = $nombre;
        $this->proyecto = $proyecto;
        $this->tarea = $tarea;
        $this->fecha_inicio = $fecha_inicio;
        $this->dias = $dias;
        $this->prioridad = $prioridad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.asignacion_tarea')
            ->with('nombre', $this->nombre)
            ->with('proyecto', $this->proyecto)
            ->with('tarea', $this->tarea)
            ->with('fecha_inicio', $this->fecha_inicio)
            ->with('dias', $this->dias)
            ->with('prioridad', $this->prioridad)
            ->from('admin@pangea.cl')
            ->subject('Pangea Gestor de Proyectos - Asignación de Tarea');
    }
}
