<?php

namespace App\Helpers\Pangea;

use Illuminate\Support\Facades\DB;

class Proyecto {

    public static function avance($id_proyecto)
    {
        $total_tareas = 0;
        $total_tareas_aprobadas = 0;
        $total_avance = 0;
        $proyecto = \App\Proyectos::find($id_proyecto);
        if (count($proyecto->hitosProyecto) > 0) {
            foreach ($proyecto->hitosProyecto as $hito) {
                if (count($hito->tareas) > 0) {
                    foreach ($hito->tareas as $tarea) {
                        $total_tareas++;
                        if ($tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_APROBADA) {
                            $total_tareas_aprobadas++;
                        }
                    }
                }
            }
        }

        if ($total_tareas > 0) {
            $total_avance = (100 * $total_tareas_aprobadas) / $total_tareas;
            $total_avance = number_format($total_avance, 2, ',','.');
        }

        return $total_avance;
    }

    public static function avancePuntual($id_proyecto)
    {
        $total_tareas = 0;
        $total_tareas_aprobadas = 0;
        $total_avance = 0;
        $proyecto = \App\Proyectos::find($id_proyecto);
        if (count($proyecto->hitosProyecto) > 0) {
            foreach ($proyecto->hitosProyecto as $hito) {
                if (count($hito->tareas) > 0) {
                    foreach ($hito->tareas as $tarea) {
                        $total_tareas += $tarea->prioridad_tarea;
                        if ($tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_APROBADA) {
                            $total_tareas_aprobadas += $tarea->prioridad_tarea;
                        }
                    }
                }
            }
        }

        if ($total_tareas > 0) {
            $total_avance = (100 * $total_tareas_aprobadas) / $total_tareas;
            $total_avance = number_format($total_avance, 2, ',','.');
        }

        return $total_avance;
    }

    public static function totalTareas($id_proyecto)
    {
        $total_tareas = 0;
        $proyecto = \App\Proyectos::find($id_proyecto);
        if (count($proyecto->hitosProyecto) > 0) {
            foreach ($proyecto->hitosProyecto as $hito) {
                if (count($hito->tareas) > 0) {
                    foreach ($hito->tareas as $tarea) {
                        $total_tareas ++;
                    }
                }
            }
        }

        return $total_tareas;
    }

    public static function totalTareasAprobadas($id_proyecto)
    {
        $total_tareas_aprobadas = 0;
        $proyecto = \App\Proyectos::find($id_proyecto);
        if (count($proyecto->hitosProyecto) > 0) {
            foreach ($proyecto->hitosProyecto as $hito) {
                if (count($hito->tareas) > 0) {
                    foreach ($hito->tareas as $tarea) {
                        if ($tarea->estado_fk_tarea == \App\EstadosTareas::TAREA_APROBADA) {
                            $total_tareas_aprobadas++;
                        }
                    }
                }
            }
        }

        return $total_tareas_aprobadas;
    }

}