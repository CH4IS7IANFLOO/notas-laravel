<?php
//pair programming
namespace Tests\Feature;

use App\Models\Calificacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusquedaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que se puede buscar calificaciones por estudiante
     */
    public function test_puede_buscar_por_estudiante(): void
    {
        // Crear datos de prueba
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Juan Pérez', 'materia' => 'Matemáticas', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'María García', 'materia' => 'Historia', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 20.0, 'estudiante' => 'Juan Pérez', 'materia' => 'Ciencias', 'fecha' => '2024-01-17']);

        $response = $this->get('/calificaciones/buscar?estudiante=Juan');

        $response->assertStatus(200);
        $response->assertSee('Juan Pérez');
        $response->assertDontSee('María García');
    }

    /**
     * Prueba que se puede buscar calificaciones por materia
     */
    public function test_puede_buscar_por_materia(): void
    {
        // Crear datos de prueba
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Matemáticas', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'Carlos', 'materia' => 'Historia', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 20.0, 'estudiante' => 'María', 'materia' => 'Matemáticas', 'fecha' => '2024-01-17']);

        $response = $this->get('/calificaciones/buscar?materia=Matemáticas');

        $response->assertStatus(200);
        $response->assertSee('Matemáticas');
        $response->assertDontSee('Historia');
    }

    /**
     * Prueba que se puede filtrar por rango de notas
     */
    public function test_puede_filtrar_por_rango_notas(): void
    {
        // Crear datos de prueba
        Calificacion::create(['nota' => 15.0, 'estudiante' => 'Ana', 'materia' => 'Matemáticas', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Carlos', 'materia' => 'Historia', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 20.0, 'estudiante' => 'María', 'materia' => 'Ciencias', 'fecha' => '2024-01-17']);

        $response = $this->get('/calificaciones/buscar?nota_min=17&nota_max=20');

        $response->assertStatus(200);
        $response->assertSee('18.0');
        $response->assertSee('20.0');
        $response->assertDontSee('15.0');
    }

    /**
     * Prueba que se puede filtrar por fecha
     */
    public function test_puede_filtrar_por_fecha(): void
    {
        // Crear datos de prueba
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Ana', 'materia' => 'Matemáticas', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'Carlos', 'materia' => 'Historia', 'fecha' => '2024-01-20']);
        Calificacion::create(['nota' => 20.0, 'estudiante' => 'María', 'materia' => 'Ciencias', 'fecha' => '2024-01-25']);

        $response = $this->get('/calificaciones/buscar?fecha_desde=2024-01-16&fecha_hasta=2024-01-24');

        $response->assertStatus(200);
        $response->assertSee('16.0');
        $response->assertDontSee('18.0');
        $response->assertDontSee('20.0');
    }

    /**
     * Prueba que se puede combinar múltiples filtros
     */
    public function test_puede_combinar_multiples_filtros(): void
    {
        // Crear datos de prueba
        Calificacion::create(['nota' => 18.0, 'estudiante' => 'Juan Pérez', 'materia' => 'Matemáticas', 'fecha' => '2024-01-15']);
        Calificacion::create(['nota' => 16.0, 'estudiante' => 'Juan Pérez', 'materia' => 'Historia', 'fecha' => '2024-01-16']);
        Calificacion::create(['nota' => 20.0, 'estudiante' => 'María García', 'materia' => 'Matemáticas', 'fecha' => '2024-01-17']);

        $response = $this->get('/calificaciones/buscar?estudiante=Juan&materia=Matemáticas&nota_min=17');

        $response->assertStatus(200);
        $response->assertSee('Juan Pérez');
        $response->assertSee('Matemáticas');
        $response->assertSee('18.0');
        $response->assertDontSee('16.0');
        $response->assertDontSee('María García');
    }
} 