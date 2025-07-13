# 📚 Sistema de Calificaciones Laravel

[![CI/CD Pipeline](https://github.com/CH4IS7IANFLOO/notas-laravel/workflows/Laravel%20CI%2FCD%20Pipeline/badge.svg)](https://github.com/CH4IS7IANFLOO/notas-laravel/actions)
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 🎯 Descripción

Sistema de gestión de calificaciones desarrollado en Laravel 12 que permite administrar notas de estudiantes con funcionalidades avanzadas de estadísticas y análisis de datos.

## ✨ Características

- **CRUD Completo**: Crear, leer, actualizar y eliminar calificaciones
- **Sistema de Estadísticas**: Análisis automático de notas pares e impares
- **Validación Robusta**: Control de rangos de notas (1-20) con decimales
- **Interfaz Moderna**: Diseño responsive con Bootstrap 5 y Font Awesome
- **Testing Completo**: Cobertura de tests con PHPUnit
- **CI/CD Pipeline**: Automatización con GitHub Actions

## 🚀 Instalación

### Requisitos
- PHP 8.2 o superior
- Composer
- MySQL 8.0 o superior
- Node.js (opcional, para assets)

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/CH4IS7IANFLOO/notas-laravel.git
cd notas-laravel
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos**
```bash
# Editar .env con tus credenciales de DB
php artisan migrate
```

5. **Ejecutar el servidor**
```bash
php artisan serve
```

## 📊 Funcionalidades

### Gestión de Calificaciones
- Registro de notas con validación (1-20 puntos)
- Información completa: estudiante, materia, fecha
- Clasificación automática par/impar

### Estadísticas Avanzadas
- Conteo de notas pares e impares
- Cálculo de sumas y promedios por tipo
- Comparación entre categorías
- Gráficos de distribución

### Interfaz de Usuario
- Diseño responsive y moderno
- Navegación intuitiva
- Feedback visual inmediato
- Confirmaciones de acciones

## 🧪 Testing

```bash
# Ejecutar todos los tests
php artisan test

# Ejecutar tests con cobertura
php artisan test --coverage

# Ejecutar tests específicos
php artisan test --filter CalificacionTest
```

## 🔧 Desarrollo

### Estructura del Proyecto
```
app/
├── Http/Controllers/CalificacionController.php
├── Models/Calificacion.php
└── Providers/
database/
├── migrations/2025_07_12_045411_create_calificacions_table.php
└── seeders/
resources/views/calificaciones/
├── index.blade.php
├── create.blade.php
├── edit.blade.php
├── show.blade.php
└── estadisticas.blade.php
tests/Feature/CalificacionTest.php
```

### Comandos Útiles
```bash
# Crear nueva calificación (seeder)
php artisan make:seeder CalificacionSeeder

# Limpiar cache
php artisan config:clear
php artisan cache:clear

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📈 CI/CD Pipeline

El proyecto incluye un pipeline completo de CI/CD con:

- **Tests Automatizados**: PHPUnit con cobertura
- **Análisis de Código**: PHP CS Fixer y PHPStan
- **Verificación de Seguridad**: Composer audit
- **Build de Producción**: Optimización automática

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

## 👨‍💻 Autor

**Christian Flores**
- GitHub: [@CH4IS7IANFLOO](https://github.com/CH4IS7IANFLOO)

---

⭐ Si este proyecto te ayuda, ¡dale una estrella!
