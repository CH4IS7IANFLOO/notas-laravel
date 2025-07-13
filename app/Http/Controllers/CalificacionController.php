<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Services\BusquedaService;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calificaciones = Calificacion::orderBy('fecha', 'desc')->get();
        $notasPares = Calificacion::getNotasPares();
        $notasImpares = Calificacion::getNotasImpares();
        $sumaPares = Calificacion::sumaNotasPares();
        $sumaImpares = Calificacion::sumaNotasImpares();

        return view('calificaciones.index', compact(
            'calificaciones',
            'notasPares',
            'notasImpares',
            'sumaPares',
            'sumaImpares'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calificaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nota' => 'required|numeric|min:1|max:20',
            'estudiante' => 'required|string|max:255',
            'materia' => 'required|string|max:255',
            'fecha' => 'required|date'
        ]);

        Calificacion::create($request->all());

        return redirect()->route('calificaciones.index')
            ->with('success', 'Calificación agregada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        return view('calificaciones.show', compact('calificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        return view('calificaciones.edit', compact('calificacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nota' => 'required|numeric|min:1|max:20',
            'estudiante' => 'required|string|max:255',
            'materia' => 'required|string|max:255',
            'fecha' => 'required|date'
        ]);

        $calificacion = Calificacion::findOrFail($id);
        $calificacion->update($request->all());

        return redirect()->route('calificaciones.index')
            ->with('success', 'Calificación actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();

        return redirect()->route('calificaciones.index')
            ->with('success', 'Calificación eliminada exitosamente');
    }

    /**
     * Muestra estadísticas de notas pares e impares
     */
    public function estadisticas()
    {
        $notasPares = Calificacion::getNotasPares();
        $notasImpares = Calificacion::getNotasImpares();
        $sumaPares = Calificacion::sumaNotasPares();
        $sumaImpares = Calificacion::sumaNotasImpares();

        return view('calificaciones.estadisticas', compact(
            'notasPares',
            'notasImpares',
            'sumaPares',
            'sumaImpares'
        ));
    }
//pair programming
    /**
     * Busca y filtra calificaciones
     */
    public function buscar(Request $request, BusquedaService $busquedaService)
    {
        $calificaciones = $busquedaService->buscar($request);
        $estadisticas = $busquedaService->obtenerEstadisticas($request);

        return view('calificaciones.buscar', compact('calificaciones', 'estadisticas'));
    }
}
