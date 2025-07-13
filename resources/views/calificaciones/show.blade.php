<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Calificación - Sistema de Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-eye"></i> Detalles de Calificación
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-user"></i> Estudiante:</h6>
                                <p class="h5">{{ $calificacion->estudiante }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-book"></i> Materia:</h6>
                                <p class="h5">{{ $calificacion->materia }}</p>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6><i class="fas fa-star"></i> Nota:</h6>
                                <span class="badge {{ $calificacion->nota % 2 == 0 ? 'bg-success' : 'bg-warning' }} fs-5">
                                    {{ $calificacion->nota }}
                                </span>
                                <small class="text-muted d-block mt-1">
                                    {{ $calificacion->nota % 2 == 0 ? 'Nota Par' : 'Nota Impar' }}
                                </small>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-calendar"></i> Fecha:</h6>
                                <p class="h5">{{ $calificacion->fecha->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h6><i class="fas fa-clock"></i> Creado:</h6>
                                <p class="text-muted">{{ $calificacion->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-edit"></i> Última actualización:</h6>
                                <p class="text-muted">{{ $calificacion->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('calificaciones.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                            <div>
                                <a href="{{ route('calificaciones.edit', $calificacion->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('calificaciones.destroy', $calificacion->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('¿Estás seguro de eliminar esta calificación?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 