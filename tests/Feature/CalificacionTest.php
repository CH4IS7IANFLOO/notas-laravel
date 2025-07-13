<?php

namespace Tests\Feature;

use App\Models\Calificacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalificacionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que se puede crear una calificación
     */
    public function test_puede_crear_calificacion(): void
    {
        $calificacion = Calificacion::create([
            'nota' => 18.5,
            'estudiante' => 'Juan Pérez',
            'materia' => 'Matemáticas',
            'fecha' => '2024-01-15'
        ]);

        $this->assertDatabaseHas('calificacions', [
            'id' => $calificacion->id,
            'nota' => 18.5,
            'estudiante' => 'Juan Pérez',
            'materia' => 'Matemáticas'
        ]);
    }

    /**
     * Prueba que se pueden obtener notas pares
     */
    public function test_puede_obtener_notas_pares(): void
    {
        // Crear calificaciones con notas pares e impares
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Historia', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 17.0, 'estudiante' => 'Carlos', 'materia' => 'Ciencias', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'María', 'materia' => 'Literatura', 'fecha' => '2024-01-17']);
        Calificacion::create(['nota' => 19.0, 'estudiante' => 'Pedro', 'materia' => 'Matemáticas', 'fecha' => '2024-01-18']);

        $notasPares = Calificacion::getNotasPares();

        $this->assertEquals(2, $notasPares->count());
        $this->assertTrue($notasPares->every(function ($nota) {
            return $nota->nota % 2 == 0;
        }));
    }

    /**
     * Prueba que se pueden obtener notas impares
     */
    public function test_puede_obtener_notas_impares(): void
    {
        // Crear calificaciones con notas pares e impares
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Historia', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 17.0, 'estudiante' => 'Carlos', 'materia' => 'Ciencias', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'María', 'materia' => 'Literatura', 'fecha' => '2024-01-17']);
        Calificacion::create(['nota' => 19.0, 'estudiante' => 'Pedro', 'materia' => 'Matemáticas', 'fecha' => '2024-01-18']);

        $notasImpares = Calificacion::getNotasImpares();

        $this->assertEquals(2, $notasImpares->count());
        $this->assertTrue($notasImpares->every(function ($nota) {
            return $nota->nota % 2 == 1;
        }));
    }

    /**
     * Prueba que se puede calcular la suma de notas pares
     */
    public function test_puede_calcular_suma_notas_pares(): void
    {
        // Crear calificaciones con notas pares e impares
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Historia', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 17.0, 'estudiante' => 'Carlos', 'materia' => 'Ciencias', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'María', 'materia' => 'Literatura', 'fecha' => '2024-01-17']);
        Calificacion::create(['nota' => 19.0, 'estudiante' => 'Pedro', 'materia' => 'Matemáticas', 'fecha' => '2024-01-18']);

        $sumaPares = Calificacion::sumaNotasPares();

        $this->assertEquals(34.0, $sumaPares); // 18.0 + 16.0 = 34.0
    }

    /**
     * Prueba que se puede calcular la suma de notas impares
     */
    public function test_puede_calcular_suma_notas_impares(): void
    {
        // Crear calificaciones con notas pares e impares
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Historia', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 17.0, 'estudiante' => 'Carlos', 'materia' => 'Ciencias', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'María', 'materia' => 'Literatura', 'fecha' => '2024-01-17']);
        Calificacion::create(['nota' => 19.0, 'estudiante' => 'Pedro', 'materia' => 'Matemáticas', 'fecha' => '2024-01-18']);

        $sumaImpares = Calificacion::sumaNotasImpares();

        $this->assertEquals(36.0, $sumaImpares); // 17.0 + 19.0 = 36.0
    }

    /**
     * Prueba que la página principal se carga correctamente
     */
    public function test_pagina_principal_se_carga(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302); // Redirige a calificaciones.index
    }

    /**
     * Prueba que la página de calificaciones se carga correctamente
     */
    public function test_pagina_calificaciones_se_carga(): void
    {
        $response = $this->get('/calificaciones');

        $response->assertStatus(200);
        $response->assertSee('Sistema de Calificaciones');
    }

    /**
     * Prueba que se puede crear una calificación desde el formulario
     */
    public function test_puede_crear_calificacion_desde_formulario(): void
    {
        $response = $this->withoutMiddleware()->post('/calificaciones', [
            'nota' => 18.5,
            'estudiante' => 'Juan Pérez',
            'materia' => 'Matemáticas',
            'fecha' => '2024-01-15'
        ]);

        $response->assertRedirect('/calificaciones');
        $this->assertDatabaseHas('calificacions', [
            'nota' => 18.5,
            'estudiante' => 'Juan Pérez',
            'materia' => 'Matemáticas'
        ]);
    }

    /**
     * Prueba validación de nota fuera de rango
     */
    public function test_valida_nota_fuera_de_rango(): void
    {
        $response = $this->withoutMiddleware()->post('/calificaciones', [
            'nota' => 21.0, // Nota fuera de rango
            'estudiante' => 'Juan Pérez',
            'materia' => 'Matemáticas',
            'fecha' => '2024-01-15'
        ]);

        $response->assertSessionHasErrors('nota');
    }

    /**
     * Prueba que la página de estadísticas se carga correctamente
     */
    public function test_pagina_estadisticas_se_carga(): void
    {
        $response = $this->get('/estadisticas');

        $response->assertStatus(200);
        $response->assertSee('Estadísticas de Calificaciones');
    }

    /**
     * Prueba que se puede eliminar una calificación
     */
    public function test_puede_eliminar_calificacion(): void
    {
        $calificacion = Calificacion::create([
            'nota' => 18.5,
            'estudiante' => 'Juan Pérez',
            'materia' => 'Matemáticas',
            'fecha' => '2024-01-15'
        ]);

        $response = $this->withoutMiddleware()->delete("/calificaciones/{$calificacion->id}");

        $response->assertRedirect('/calificaciones');
        $this->assertDatabaseMissing('calificacions', ['id' => $calificacion->id]);
    }

/* TDD */
    /**
     * Prueba que se puede calcular el promedio por materia
     */
    public function test_puede_calcular_promedio_por_materia(): void
    {
        // Crear calificaciones para la misma materia
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Matemáticas', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'Carlos', 'materia' => 'Matemáticas', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 20.0, 'estudiante' => 'María', 'materia' => 'Matemáticas', 'fecha' => '2024-01-17']);

        $promedio = Calificacion::promedioPorMateria('Matemáticas');

        $this->assertEquals(18.0, $promedio); // (18 + 16 + 20) / 3 = 18
    }

    /**
     * Prueba que el promedio por materia devuelve 0 si no hay calificaciones
     */
    public function test_promedio_por_materia_devuelve_cero_si_no_hay_calificaciones(): void
    {
        $promedio = Calificacion::promedioPorMateria('MateriaInexistente');

        $this->assertEquals(0, $promedio);
    }
}
