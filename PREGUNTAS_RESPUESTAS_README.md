# Sistema de Preguntas y Respuestas para Profesionales

## Descripción
Este sistema permite que los profesionales de la salud respondan preguntas específicas de su área de especialización. Las preguntas se muestran automáticamente a los profesionales que tienen esa especialidad registrada en su perfil.

## Características Implementadas

### Para Profesionales:
- ✅ Ver preguntas de su especialidad sin responder
- ✅ Responder preguntas con validación
- ✅ Ver sus propias respuestas enviadas
- ✅ Ver respuestas de otros profesionales
- ✅ Prevenir respuestas duplicadas del mismo profesional
- ✅ Interface con pestañas para organizar el contenido

### Funcionalidades Técnicas:
- ✅ Filtrado automático por especialidades del profesional
- ✅ Validación de permisos (solo pueden responder especialistas de esa área)
- ✅ Respuestas en tiempo real con AJAX
- ✅ Paginación para preguntas y respuestas
- ✅ Notificaciones visuales con SweetAlert2

## Archivos Modificados/Creados

### Configuración y Rutas:
- `config/adminlte.php` - Agregado menú "Preguntas y Respuestas"
- `routes/web.php` - Rutas para ver y responder preguntas

### Controladores:
- `app/Http/Controllers/ProfesionalController.php` - Métodos agregados:
  - `preguntasRespuestas()` - Vista principal
  - `responderPregunta()` - Procesar respuestas vía AJAX

### Modelos:
- `app/Models/Profesional.php` - Relación `respuestasExpertos()`
- `app/Models/Especialidad.php` - Relaciones para preguntas y profesionales
- `app/Models/PreguntaExperto.php` - Ya existía
- `app/Models/RespuestaExperto.php` - Ya existía

### Vistas:
- `resources/views/profesionales/preguntas-respuestas.blade.php` - Vista principal

### Base de Datos:
- `database/seeders/PreguntasExpertosSeeder.php` - Preguntas de ejemplo
- `database/seeders/DatabaseSeeder.php` - Registro del seeder
- `app/Console/Commands/CrearPreguntasEjemplo.php` - Comando para ejecutar seeder

## Instalación y Configuración

### 1. Ejecutar las migraciones (si no están ejecutadas)
```bash
php artisan migrate
```

### 2. Crear preguntas de ejemplo
```bash
php artisan app:crear-preguntas-ejemplo
```

### 3. Verificar especialidades
Asegúrate de que los profesionales tengan especialidades asignadas en la tabla `especializaciones`.

## Uso del Sistema

### Para Profesionales:
1. Iniciar sesión como profesional
2. Ir a "Preguntas y Respuestas" en el menú lateral
3. Ver preguntas sin responder en la primera pestaña
4. Hacer clic en "Responder" para contestar una pregunta
5. Ver las respuestas enviadas en la segunda pestaña

### Para Administradores:
- Las preguntas se pueden gestionar desde el panel de administración existente
- Se pueden crear nuevas preguntas manualmente en la BD o mediante seeders

## Estructura de la Base de Datos

### Tablas Relacionadas:
- `preguntas_expertos` - Preguntas por especialidad
- `respuestas_expertos` - Respuestas de profesionales
- `especialidades` - Especialidades médicas
- `especializaciones` - Especialidades por profesional
- `profesionales` - Datos de profesionales

### Relaciones:
- Un profesional puede tener múltiples especializaciones
- Una pregunta pertenece a una especialidad (y opcionalmente a una sub-especialidad)
- Una pregunta puede tener múltiples respuestas
- Una respuesta pertenece a un profesional y a una pregunta

## Validaciones Implementadas

1. **Autorización**: Solo profesionales con la especialidad correspondiente pueden responder
2. **Respuesta única**: Un profesional no puede responder dos veces la misma pregunta
3. **Longitud mínima**: Las respuestas deben tener al menos 10 caracteres
4. **Autenticación**: Solo usuarios logueados pueden acceder

## Próximas Mejoras Sugeridas

- [ ] Sistema de notificaciones cuando hay nuevas preguntas
- [ ] Búsqueda y filtros avanzados
- [ ] Sistema de puntuación/valoración de respuestas
- [ ] Exportar respuestas a PDF
- [ ] Panel de estadísticas para profesionales
- [ ] Moderación de preguntas y respuestas
- [ ] Etiquetas adicionales para categorizar preguntas

## Troubleshooting

### Si no se muestran preguntas:
1. Verificar que el profesional tenga especialidades asignadas
2. Ejecutar el seeder para crear preguntas de ejemplo
3. Verificar que las relaciones en los modelos estén correctas

### Si no se pueden enviar respuestas:
1. Verificar el token CSRF en el meta tag
2. Revisar permisos del profesional
3. Verificar que JavaScript esté habilitado

## Soporte
Para dudas o problemas, revisar los logs de Laravel en `storage/logs/laravel.log`.
