<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-graduation-cap text-primary"></i>
                    Sistema de Calificaciones
                </h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
//pair programming
        <!-- Botones de acción -->
        <div class="row mb-4">
            <div class="col-md-4">
                <a href="{{ route('calificaciones.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nueva Calificación
                </a>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ route('calificaciones.buscar') }}" class="btn btn-success">
                    <i class="fas fa-search"></i> Búsqueda Avanzada
                </a>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('calificaciones.estadisticas') }}" class="btn btn-info">
                    <i class="fas fa-chart-bar"></i> Ver Estadísticas
                </a>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-list"></i> Total Calificaciones</h5>
                        <h3>{{ $calificaciones->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-check-circle"></i> Notas Pares</h5>
                        <h3>{{ $notasPares->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-exclamation-circle"></i> Notas Impares</h5>
                        <h3>{{ $notasImpares->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-calculator"></i> Promedio</h5>
                        <h3>{{ $calificaciones->count() > 0 ? number_format($calificaciones->avg('nota'), 1) : '0.0' }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de calificaciones -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-table"></i> Lista de Calificaciones</h5>
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
                                                <form action="{{ route('calificaciones.destroy', $calificacion->id) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            onclick="return confirm('¿Estás seguro de eliminar esta calificación?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No hay calificaciones registradas</h5>
                        <p class="text-muted">Comienza agregando la primera calificación</p>
                        <a href="{{ route('calificaciones.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar Calificación
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 