<?php
//pair programming
namespace App\Services;

use App\Models\Calificacion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BusquedaService
{
    /**
     * Aplica filtros de búsqueda a la consulta de calificaciones
     */
    public function aplicarFiltros(Request $request): Builder
    {
        $query = Calificacion::query();

        // Filtro por estudiante
        if ($request->filled('estudiante')) {
            $query->where('estudiante', 'like', '%' . $request->estudiante . '%');
        }

        // Filtro por materia
        if ($request->filled('materia')) {
            $query->where('materia', 'like', '%' . $request->materia . '%');
        }

        // Filtro por rango de notas
        if ($request->filled('nota_min')) {
            $query->where('nota', '>=', $request->nota_min);
        }
        if ($request->filled('nota_max')) {
            $query->where('nota', '<=', $request->nota_max);
        }

        // Filtro por fecha
        if ($request->filled('fecha_desde')) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }
        if ($request->filled('fecha_hasta')) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }

        return $query->orderBy('fecha', 'desc');
    }

    /**
     * Obtiene calificaciones con filtros aplicados
     */
    public function buscar(Request $request)
    {
        $query = $this->aplicarFiltros($request);
        return $query->get();
    }

    /**
     * Obtiene estadísticas de la búsqueda
     */
    public function obtenerEstadisticas(Request $request): array
    {
        $calificaciones = $this->buscar($request);
        
        return [
            'total' => $calificaciones->count(),
            'promedio' => $calificaciones->count() > 0 ? round($calificaciones->avg('nota'), 1) : 0,
            'nota_maxima' => $calificaciones->count() > 0 ? $calificaciones->max('nota') : 0,
            'nota_minima' => $calificaciones->count() > 0 ? $calificaciones->min('nota') : 0,
        ];
    }
} 