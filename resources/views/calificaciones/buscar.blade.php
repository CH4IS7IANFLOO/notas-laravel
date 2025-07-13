<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda Avanzada - Sistema de Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-search text-primary"></i>
                    Búsqueda Avanzada
                </h1>
            </div>
        </div>

        <!-- Formulario de búsqueda -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-filter"></i> Filtros de Búsqueda</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('calificaciones.buscar') }}" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="estudiante" class="form-label">
                                <i class="fas fa-user"></i> Estudiante
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="estudiante" 
                                   name="estudiante" 
                                   value="{{ request('estudiante') }}"
                                   placeholder="Buscar por nombre...">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="materia" class="form-label">
                                <i class="fas fa-book"></i> Materia
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="materia" 
                                   name="materia" 
                                   value="{{ request('materia') }}"
                                   placeholder="Buscar por materia...">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="nota_min" class="form-label">
                                <i class="fas fa-star"></i> Nota Mín
                            </label>
                            <input type="number" 
                                   class="form-control" 
                                   id="nota_min" 
                                   name="nota_min" 
                                   value="{{ request('nota_min') }}"
                                   min="1" 
                                   max="20" 
                                   step="0.1"
                                   placeholder="1">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="nota_max" class="form-label">
                                <i class="fas fa-star"></i> Nota Máx
                            </label>
                            <input type="number" 
                                   class="form-control" 
                                   id="nota_max" 
                                   name="nota_max" 
                                   value="{{ request('nota_max') }}"
                                   min="1" 
                                   max="20" 
                                   step="0.1"
                                   placeholder="20">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">
                                <i class="fas fa-calendar"></i> Fecha
                            </label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" 
                                           class="form-control" 
                                           name="fecha_desde" 
                                           value="{{ request('fecha_desde') }}"
                                           placeholder="Desde">
                                </div>
                                <div class="col-6">
                                    <input type="date" 
                                           class="form-control" 
                                           name="fecha_hasta" 
                                           value="{{ request('fecha_hasta') }}"
                                           placeholder="Hasta">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('calificaciones.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <div>
                                    <button type="reset" class="btn btn-warning">
                                        <i class="fas fa-undo"></i> Limpiar
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
//pair programming
        <!-- Estadísticas de búsqueda -->
        @if($calificaciones->count() > 0)
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h5><i class="fas fa-list"></i> Total</h5>
                            <h3>{{ $estadisticas['total'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5><i class="fas fa-calculator"></i> Promedio</h5>
                            <h3>{{ $estadisticas['promedio'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h5><i class="fas fa-arrow-up"></i> Máxima</h5>
                            <h3>{{ $estadisticas['nota_maxima'] }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h5><i class="fas fa-arrow-down"></i> Mínima</h5>
                            <h3>{{ $estadisticas['nota_minima'] }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Resultados de búsqueda -->
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-list"></i> Resultados ({{ $calificaciones->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($calificaciones->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Estudiante</th>
                                    <th>Materia</th>
                                    <th>Nota</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($calificaciones as $calificacion)
                                    <tr>
                                        <td>{{ $calificacion->id }}</td>
                                        <td>{{ $calificacion->estudiante }}</td>
                                        <td>{{ $calificacion->materia }}</td>
                                        <td>
                                            <span class="badge {{ $calificacion->nota % 2 == 0 ? 'bg-success' : 'bg-warning' }}">
                                                {{ $calificacion->nota }}
                                            </span>
                                        </td>
                                        <td>{{ $calificacion->fecha->format('d/m/Y') }}</td>
                                        <td>
                                            @if($calificacion->nota % 2 == 0)
                                                <span class="badge bg-success">Par</span>
                                            @else
                                                <span class="badge bg-warning">Impar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('calificaciones.show', $calificacion->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('calificaciones.edit', $calificacion->id) }}" 
                                                   class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No se encontraron resultados</h5>
                        <p class="text-muted">Intenta ajustar los filtros de búsqueda</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 