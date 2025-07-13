<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $fillable = [
        'nota',
        'estudiante',
        'materia',
        'fecha'
    ];

    protected $casts = [
        'fecha' => 'date',
        'nota' => 'decimal:1'
    ];

    /**
     * Obtiene todas las calificaciones pares
     */
    public static function getNotasPares()
    {
        return self::whereRaw('nota % 2 = 0')->get();
    }

    /**
     * Obtiene todas las calificaciones impares
     */
    public static function getNotasImpares()
    {
        return self::whereRaw('nota % 2 = 1')->get();
    }

    /**
     * Calcula la suma de las notas pares
     */
    public static function sumaNotasPares()
    {
        return self::whereRaw('nota % 2 = 0')->sum('nota');
    }

    /**
     * Calcula la suma de las notas impares
     */
    public static function sumaNotasImpares()
    {
        return self::whereRaw('nota % 2 = 1')->sum('nota');
    }
}
