<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas - Sistema de Calificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">
                    <i class="fas fa-chart-bar text-info"></i>
                    Estadísticas de Calificaciones
                </h1>
            </div>
        </div>

        <!-- Botón de regreso -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('calificaciones.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Inicio
                </a>
            </div>
        </div>

        <!-- Resumen de estadísticas -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h4><i class="fas fa-check-circle"></i> Notas Pares</h4>
                        <h2>{{ $notasPares->count() }}</h2>
                        <p class="mb-0">Total de calificaciones</p>
                        <hr>
                        <h3>Suma: {{ number_format($sumaPares, 1) }}</h3>
                        @if($notasPares->count() > 0)
                            <p>Promedio: {{ number_format($sumaPares / $notasPares->count(), 1) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h4><i class="fas fa-exclamation-circle"></i> Notas Impares</h4>
                        <h2>{{ $notasImpares->count() }}</h2>
                        <p class="mb-0">Total de calificaciones</p>
                        <hr>
                        <h3>Suma: {{ number_format($sumaImpares, 1) }}</h3>
                        @if($notasImpares->count() > 0)
                            <p>Promedio: {{ number_format($sumaImpares / $notasImpares->count(), 1) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Comparación -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-balance-scale"></i> Comparación</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Diferencia (Pares - Impares):</h6>
                                <h3 class="text-{{ ($sumaPares - $sumaImpares) >= 0 ? 'success' : 'danger' }}">
                                    {{ number_format($sumaPares - $sumaImpares, 1) }}
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <h6>Total General:</h6>
                                <h3 class="text-primary">{{ number_format($sumaPares + $sumaImpares, 1) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalle de notas pares -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-list"></i> Detalle de Notas Pares ({{ $notasPares->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($notasPares->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Estudiante</th>
                                            <th>Materia</th>
                                            <th>Nota</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notasPares as $nota)
                                            <tr>
                                                <td>{{ $nota->estudiante }}</td>
                                                <td>{{ $nota->materia }}</td>
                                                <td><span class="badge bg-success">{{ $nota->nota }}</span></td>
                                                <td>{{ $nota->fecha->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted text-center">No hay notas pares registradas</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detalle de notas impares -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-list"></i> Detalle de Notas Impares ({{ $notasImpares->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($notasImpares->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Estudiante</th>
                                            <th>Materia</th>
                                            <th>Nota</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notasImpares as $nota)
                                            <tr>
                                                <td>{{ $nota->estudiante }}</td>
                                                <td>{{ $nota->materia }}</td>
                                                <td><span class="badge bg-warning">{{ $nota->nota }}</span></td>
                                                <td>{{ $nota->fecha->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted text-center">No hay notas impares registradas</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de distribución -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Distribución</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Notas Pares:</h6>
                                <div class="progress mb-3">
                                    @php
                                        $total = $notasPares->count() + $notasImpares->count();
                                        $porcentajePares = $total > 0 ? ($notasPares->count() / $total) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-success" style="width: {{ $porcentajePares }}%">
                                        {{ number_format($porcentajePares, 1) }}%
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Notas Impares:</h6>
                                <div class="progress mb-3">
                                    @php
                                        $porcentajeImpares = $total > 0 ? ($notasImpares->count() / $total) * 100 : 0;
                                    @endphp
                                    <div class="progress-bar bg-warning" style="width: {{ $porcentajeImpares }}%">
                                        {{ number_format($porcentajeImpares, 1) }}%
                                    </div>
                                </div>
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