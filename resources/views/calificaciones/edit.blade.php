<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Calificación - Sistema de Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-edit"></i> Editar Calificación
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('calificaciones.update', $calificacion->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="estudiante" class="form-label">
                                        <i class="fas fa-user"></i> Estudiante
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('estudiante') is-invalid @enderror" 
                                           id="estudiante" 
                                           name="estudiante" 
                                           value="{{ old('estudiante', $calificacion->estudiante) }}" 
                                           required>
                                    @error('estudiante')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="materia" class="form-label">
                                        <i class="fas fa-book"></i> Materia
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('materia') is-invalid @enderror" 
                                           id="materia" 
                                           name="materia" 
                                           value="{{ old('materia', $calificacion->materia) }}" 
                                           required>
                                    @error('materia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nota" class="form-label">
                                        <i class="fas fa-star"></i> Nota (1-20)
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('nota') is-invalid @enderror" 
                                           id="nota" 
                                           name="nota" 
                                           value="{{ old('nota', $calificacion->nota) }}" 
                                           min="1" 
                                           max="20" 
                                           step="0.1" 
                                           required>
                                    <div class="form-text">Ingresa una nota entre 1 y 20 (puede incluir decimales)</div>
                                    @error('nota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fecha" class="form-label">
                                        <i class="fas fa-calendar"></i> Fecha
                                    </label>
                                    <input type="date" 
                                           class="form-control @error('fecha') is-invalid @enderror" 
                                           id="fecha" 
                                           name="fecha" 
                                           value="{{ old('fecha', $calificacion->fecha->format('Y-m-d')) }}" 
                                           required>
                                    @error('fecha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i>
                                        <strong>Información:</strong> Las notas se clasificarán automáticamente como pares o impares para el cálculo de estadísticas.
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('calificaciones.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                                <div>
                                    <a href="{{ route('calificaciones.show', $calificacion->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i> Ver Detalles
                                    </a>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-save"></i> Actualizar Calificación
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 