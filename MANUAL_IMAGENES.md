# Manual de Implementación - Carga de Imágenes para Proveedores

## Cambios Realizados

### 1. Frontend (Blade Template)

#### Campos de Input
Se cambiaron los campos de texto por campos de tipo `file`:

```blade
<!-- Antes -->
<input type="text" name="imagenes" id="imagenes" class="form-control form-input"
    placeholder="URL de imágenes" value="{{ $proveedor->imagenes ?? '' }}" disabled>

<!-- Después -->
<input type="file" name="imagenes" id="imagenes" class="form-control-file form-input"
    accept="image/*" disabled>
```

#### Previsualización de Imágenes
Se agregó funcionalidad para mostrar:
- Imagen actual (si existe)
- Previsualización de nueva imagen seleccionada
- Botón para remover previsualización

### 2. Backend (Controlador)

#### Validación
Se agregaron reglas de validación para los archivos:

```php
'imagenes' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
'imagen_corporativa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
```

#### Función de Guardado Adaptada

```php
// Manejar carga de imagen general
$imagenesPath = $proveedor->imagenes; // Mantener la imagen actual por defecto
if ($request->hasFile('imagenes')) {
    $file = $request->file('imagenes');
    $filename = Str::slug($proveedor->id . '-imagenes-' . time()) . '.' . $file->getClientOriginalExtension();
    $path = 'imagenes/proveedores/' . $proveedor->id . '/imagenes';
    
    // Crear directorio si no existe
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0755, true);
    }
    
    $file->move(public_path($path), $filename);
    $imagenesPath = $path . '/' . $filename;
}

// Manejar carga de imagen corporativa/logo
$imagenCorporativaPath = $proveedor->imagen_corporativa; // Mantener la imagen actual por defecto
if ($request->hasFile('imagen_corporativa')) {
    $file = $request->file('imagen_corporativa');
    $filename = Str::slug($proveedor->id . '-logo-' . time()) . '.' . $file->getClientOriginalExtension();
    $path = 'imagenes/proveedores/' . $proveedor->id . '/logo';
    
    // Crear directorio si no existe
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0755, true);
    }
    
    $file->move(public_path($path), $filename);
    $imagenCorporativaPath = $path . '/' . $filename;
}
```

### 3. Estructura de Directorios

Las imágenes se guardan con la siguiente estructura:

```
public/
├── imagenes/
│   └── proveedores/
│       └── {proveedor_id}/
│           ├── imagenes/
│           │   └── {proveedor_id}-imagenes-{timestamp}.{ext}
│           └── logo/
│               └── {proveedor_id}-logo-{timestamp}.{ext}
```

### 4. JavaScript Mejorado

#### Previsualización
- Funciones para mostrar previsualización de imágenes seleccionadas
- Botón para remover previsualización
- Limpieza automática al cancelar edición

#### Manejo de Estados
- Los inputs de archivo no se incluyen en la restauración de valores
- Se limpian las previsualizaciones al cancelar

## Características Implementadas

✅ **Carga de archivos**: Inputs de tipo file con validación
✅ **Previsualización**: Vista previa de imágenes antes de guardar
✅ **Directorios organizados**: Separación por proveedor y tipo de imagen
✅ **Validación**: Tipos de archivo y tamaño máximo
✅ **Mantenimiento**: Las imágenes actuales se conservan si no se suben nuevas
✅ **UX mejorada**: Indicadores visuales y manejo de estados

## Uso

1. **Editar datos**: Click en "Editar datos"
2. **Seleccionar imagen**: Click en los campos de archivo para elegir imágenes
3. **Previsualizar**: Las imágenes seleccionadas se muestran automáticamente
4. **Guardar**: Click en "Guardar cambios" para aplicar los cambios
5. **Cancelar**: Click en "Cancelar" para descartar cambios y limpiar previsualizaciones

## Notas Técnicas

- **Tamaño máximo**: 2MB por imagen
- **Formatos soportados**: JPEG, PNG, JPG, GIF, SVG
- **Nombres de archivo**: Se generan automáticamente con slug y timestamp
- **Permisos**: Los directorios se crean con permisos 0755
- **Compatibilidad**: Funciona con el sistema de edición existente
