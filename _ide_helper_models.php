<?php

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $paciente_id
 * @property string|null $alergias
 * @property string|null $condiciones_medicas
 * @property string|null $medicamentos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Paciente $paciente
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente whereAlergias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente whereCondicionesMedicas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente whereMedicamentos($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Antecedente whereUpdatedAt($value)
 */
	class Antecedente extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $titulo
 * @property string $slug
 * @property string $resumen
 * @property string $contenido
 * @property string|null $imagen_destacada
 * @property string $estado
 * @property int $categoria_id
 * @property int $autor_id
 * @property \Illuminate\Support\Carbon|null $fecha_publicacion
 * @property array<array-key, mixed>|null $seo
 * @property int $vistas
 * @property bool $destacado
 * @property bool $permite_comentarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $autor
 * @property-read \App\Models\CategoriaBlog $categoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EtiquetaBlog> $etiquetas
 * @property-read int|null $etiquetas_count
 * @property-read mixed $resumen_corto
 * @property-read mixed $tiempo_lectura
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog buscar($termino)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog destacado()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog porCategoria($categoriaId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog publicado()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereAutorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereContenido($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereDestacado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereFechaPublicacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereImagenDestacada($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog wherePermiteComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereResumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereSeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArticuloBlog whereVistas($value)
 */
	class ArticuloBlog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * @property string|null $descripcion
 * @property bool $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticuloBlog> $articulos
 * @property-read int|null $articulos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog activo()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaBlog whereUpdatedAt($value)
 */
	class CategoriaBlog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $orden
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoriaProfesional whereUpdatedAt($value)
 */
	class CategoriaProfesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $paciente_id
 * @property int $profesional_id
 * @property string $fecha_hora
 * @property string $codigo_qr
 * @property string $modalidad
 * @property string|null $motivo
 * @property int|null $consultorio_id
 * @property string|null $url_meet
 * @property string $estado
 * @property int $recordatorio_enviado
 * @property int $informe_creado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $especializacion_id
 * @property-read \App\Models\ConsultorioProfesional|null $consultorio
 * @property-read \App\Models\DetalleCita|null $detalleCita
 * @property-read \App\Models\EspecializacionesProfesional|null $especializacion
 * @property-read \App\Models\InformeConsulta|null $informeConsulta
 * @property-read \App\Models\Paciente $paciente
 * @property-read \App\Models\Profesional $profesional
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereCodigoQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereConsultorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereEspecializacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereInformeCreado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereModalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereRecordatorioEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cita whereUrlMeet($value)
 */
	class Cita extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $provincia_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Provincia $provincia
 * @property-read \App\Models\Region|null $region
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad whereProvinciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ciudad whereUpdatedAt($value)
 */
	class Ciudad extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $consultorio_id
 * @property string $imagen_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ConsultorioProfesional $consultorio
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen whereConsultorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen whereImagenPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioImagen whereUpdatedAt($value)
 */
	class ConsultorioImagen extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string $direccion
 * @property string|null $direccion_maps
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConsultorioImagen> $imagenes
 * @property string|null $clinica
 * @property string|null $info_adicional
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $imagenes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereClinica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereDireccionMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereImagenes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereInfoAdicional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConsultorioProfesional whereUpdatedAt($value)
 */
	class ConsultorioProfesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string $motivo
 * @property string $descripcion
 * @property string $estado
 * @property string|null $respuesta
 * @property string|null $fecha_respuesta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Profesional $profesional
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereFechaRespuesta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereRespuesta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProfesional whereUpdatedAt($value)
 */
	class ContactoAdminProfesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $proveedor_id
 * @property string $motivo
 * @property string $descripcion
 * @property string $estado
 * @property string|null $respuesta
 * @property string|null $fecha_respuesta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Proveedor $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereFechaRespuesta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereRespuesta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactoAdminProveedores whereUpdatedAt($value)
 */
	class ContactoAdminProveedores extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $paciente_id
 * @property string $nombre
 * @property string|null $relacion
 * @property string $telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia whereRelacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContactosEmergencia whereUpdatedAt($value)
 */
	class ContactosEmergencia extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cita_id
 * @property int|null $metodo_pago_id
 * @property string $estado_pago
 * @property string|null $fecha_pago
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $monto
 * @property-read \App\Models\Cita $cita
 * @property-read \App\Models\MetodoPago|null $metodoPago
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereCitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereEstadoPago($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereFechaPago($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereMetodoPagoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereMonto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleCita whereUpdatedAt($value)
 */
	class DetalleCita extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $horario_id
 * @property string $hora_desde
 * @property string $hora_hasta
 * @property int $bloqueado
 * @property int|null $consultorio_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ConsultorioProfesional|null $consultorio
 * @property-read \App\Models\HorarioProfesional $horario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereBloqueado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereConsultorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereHoraDesde($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereHoraHasta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereHorarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorario whereUpdatedAt($value)
 */
	class DetalleHorario extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $horario_id
 * @property string $hora_desde
 * @property string $hora_hasta
 * @property int $bloqueado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HorarioVideollamada $horario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereBloqueado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereHoraDesde($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereHoraHasta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereHorarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetalleHorarioVideollamada whereUpdatedAt($value)
 */
	class DetalleHorarioVideollamada extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string $tipo
 * @property string $archivo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $nombre
 * @property string|null $estado
 * @property-read \App\Models\Profesional $profesional
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentoProfesional whereUpdatedAt($value)
 */
	class DocumentoProfesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $proveedor_id
 * @property string $tipo
 * @property string $archivo
 * @property string|null $nombre
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Proveedor $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DocumentosProveedor whereUpdatedAt($value)
 */
	class DocumentosProveedor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string $tipo
 * @property int $provincia_id
 * @property int $ciudad_id
 * @property string $direccion
 * @property string|null $telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $region_id
 * @property-read \App\Models\Ciudad $ciudad
 * @property-read \App\Models\Provincia $provincia
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereCiudadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereProvinciaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Emergencia whereUpdatedAt($value)
 */
	class Emergencia extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $padre_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EspecializacionesProfesional> $especializacionesProfesional
 * @property-read int|null $especializaciones_profesional_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Especialidad> $hijos
 * @property-read int|null $hijos_count
 * @property-read Especialidad|null $padre
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PreguntaExperto> $preguntasExpertos
 * @property-read int|null $preguntas_expertos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PreguntaExperto> $preguntasExpertosComoSub
 * @property-read int|null $preguntas_expertos_como_sub_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad wherePadreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Especialidad whereUpdatedAt($value)
 */
	class Especialidad extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property int $categoria_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CategoriaProfesional $categoria
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecialidadSanitario whereUpdatedAt($value)
 */
	class EspecialidadSanitario extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property int $especialidad_id
 * @property int|null $sub_especialidad_id
 * @property string $centro_educativo
 * @property string $pais
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $precio_presencial
 * @property string $precio_videoconsulta
 * @property-read \App\Models\Especialidad $especialidad
 * @property-read \App\Models\Profesional $profesional
 * @property-read \App\Models\Especialidad|null $subespecialidad
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereCentroEducativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereEspecialidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional wherePais($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional wherePrecioPresencial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional wherePrecioVideoconsulta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereSubEspecialidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EspecializacionesProfesional whereUpdatedAt($value)
 */
	class EspecializacionesProfesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string $slug
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ArticuloBlog> $articulos
 * @property-read int|null $articulos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EtiquetaBlog whereUpdatedAt($value)
 */
	class EtiquetaBlog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string $puesto
 * @property string $clinica
 * @property string $pais
 * @property string|null $anyo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral whereAnyo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral whereClinica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral wherePais($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral wherePuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExperienciaLaboral whereUpdatedAt($value)
 */
	class ExperienciaLaboral extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string $tipo
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FormacionAdicional whereUpdatedAt($value)
 */
	class FormacionAdicional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property int|null $dia_semana
 * @property string|null $fecha
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DetalleHorario> $detalles
 * @property-read int|null $detalles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional whereDiaSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioProfesional whereUpdatedAt($value)
 */
	class HorarioProfesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string|null $dia_semana
 * @property string|null $fecha
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DetalleHorarioVideollamada> $detalles
 * @property-read int|null $detalles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada whereDiaSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HorarioVideollamada whereUpdatedAt($value)
 */
	class HorarioVideollamada extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $prueba_id
 * @property string $ruta
 * @property string|null $descripcion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Prueba $prueba
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba wherePruebaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba whereRuta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ImagenesPrueba whereUpdatedAt($value)
 */
	class ImagenesPrueba extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cita_id
 * @property string|null $motivo_consulta
 * @property string|null $antecedentes_familiares
 * @property string|null $antecedentes_personales
 * @property string|null $enfermedad_actual
 * @property string|null $exploracion_fisica
 * @property string|null $pruebas_complementarias
 * @property string|null $juicio_clinico
 * @property string|null $dibujo_dental
 * @property string|null $plan_terapeutico
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cita $cita
 * @property-read \App\Models\PedidoImagen|null $pedidoImagen
 * @property-read \App\Models\PedidoLaboratorio|null $pedidoLaboratorio
 * @property-read \App\Models\Receta|null $receta
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereAntecedentesFamiliares($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereAntecedentesPersonales($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereCitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereDibujoDental($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereEnfermedadActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereExploracionFisica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereJuicioClinico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereMotivoConsulta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta wherePlanTerapeutico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta wherePruebasComplementarias($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformeConsulta whereUpdatedAt($value)
 */
	class InformeConsulta extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|IntervaloMedicamento whereUpdatedAt($value)
 */
	class IntervaloMedicamento extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medicamento whereUpdatedAt($value)
 */
	class Medicamento extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $receta_id
 * @property int $medicamento_id
 * @property int $presentacion_medicamentos_id
 * @property string $dosis
 * @property int $via_administracion_medicamentos_id
 * @property int $intervalo_medicamentos_id
 * @property string $duracion
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\IntervaloMedicamento|null $intervalo
 * @property-read \App\Models\Medicamento $medicamento
 * @property-read \App\Models\PresentacionMedicamento|null $presentacion
 * @property-read \App\Models\ViaAdministracionMedicamento|null $viaAdministracion
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereDosis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereDuracion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereIntervaloMedicamentosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereMedicamentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta wherePresentacionMedicamentosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereRecetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MedicamentoReceta whereViaAdministracionMedicamentosId($value)
 */
	class MedicamentoReceta extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Profesional> $profesionales
 * @property-read int|null $profesionales_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MetodoPago whereUpdatedAt($value)
 */
	class MetodoPago extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $titulo
 * @property string $mensaje
 * @property string $tipo
 * @property string|null $icono
 * @property string|null $url
 * @property bool $leida
 * @property int|null $usuario_id
 * @property int|null $usuario_id_destino
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $usuario
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion activas()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion noLeidas()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereIcono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereLeida($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereMensaje($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereTitulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereUsuarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notificacion whereUsuarioIdDestino($value)
 */
	class Notificacion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $foto
 * @property string $nombre_completo
 * @property string|null $fecha_nacimiento
 * @property string|null $genero
 * @property string|null $estado_civil
 * @property string|null $nacionalidad
 * @property string|null $celular
 * @property string $email
 * @property string|null $direccion
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $cedula
 * @property string|null $grupo_sanguineo
 * @property int|null $ciudad_id
 * @property int|null $profesional_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Antecedente> $antecedentes
 * @property-read int|null $antecedentes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cita> $citas
 * @property-read int|null $citas_count
 * @property-read \App\Models\Ciudad|null $ciudad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactosEmergencia> $contactos_emergencia
 * @property-read int|null $contactos_emergencia_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SegurosMedicos> $segurosMedicos
 * @property-read int|null $seguros_medicos_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Valoracion> $valoraciones
 * @property-read int|null $valoraciones_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereCedula($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereCelular($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereCiudadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereEstadoCivil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereGrupoSanguineo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereNacionalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereNombreCompleto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Paciente whereUserId($value)
 */
	class Paciente extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $qr
 * @property string $fecha_hora
 * @property string|null $motivo
 * @property string|null $sintomas
 * @property string|null $antecedentes
 * @property int $informe_consulta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InformeConsulta $informeConsulta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Prueba> $pruebas
 * @property-read int|null $pruebas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereAntecedentes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereInformeConsultaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereSintomas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoImagen whereUpdatedAt($value)
 */
	class PedidoImagen extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $qr
 * @property string|null $fecha_hora
 * @property string|null $motivo
 * @property string|null $sintoma
 * @property string|null $antecedentes
 * @property int $informe_consulta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InformeConsulta $informeConsulta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Prueba> $pruebas
 * @property-read int|null $pruebas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereAntecedentes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereFechaHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereInformeConsultaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereMotivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereSintoma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoLaboratorio whereUpdatedAt($value)
 */
	class PedidoLaboratorio extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $precio
 * @property string $caracteristicas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Profesional> $profesionales
 * @property-read int|null $profesionales_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereCaracteristicas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plan whereUpdatedAt($value)
 */
	class Plan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $especialidad_id
 * @property int|null $sub_especialidad_id
 * @property string $pregunta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $categoria_id
 * @property-read \App\Models\CategoriaProfesional $categoria
 * @property-read \App\Models\Especialidad|null $especialidad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RespuestaExperto> $respuestas
 * @property-read int|null $respuestas_count
 * @property-read \App\Models\Especialidad|null $subespecialidad
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto whereEspecialidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto wherePregunta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto whereSubEspecialidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PreguntaExperto whereUpdatedAt($value)
 */
	class PreguntaExperto extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresentacionMedicamento whereUpdatedAt($value)
 */
	class PresentacionMedicamento extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $prueba_id
 * @property float|null $precio
 * @property int $proveedor_id
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Proveedor $proveedor
 * @property-read \App\Models\Prueba $prueba
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba wherePruebaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PresupuestoPrueba whereUpdatedAt($value)
 */
	class PresupuestoPrueba extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre_completo
 * @property string|null $foto
 * @property string|null $logo
 * @property string|null $fecha_nacimiento
 * @property string|null $genero
 * @property string|null $telefono_personal
 * @property string|null $telefono_profesional
 * @property string|null $cedula_identidad
 * @property string $email
 * @property string|null $idiomas
 * @property string|null $descripcion_profesional
 * @property int|null $anios_experiencia
 * @property string|null $licencia_medica
 * @property int|null $user_id
 * @property string|null $numero_cuenta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $plan_id
 * @property string|null $num_colegiado
 * @property int|null $categoria_id
 * @property int|null $ciudad_id
 * @property int $presencial
 * @property int $videoconsulta
 * @property string|null $sello
 * @property string|null $firma
 * @property-read \App\Models\CategoriaProfesional|null $categoria
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cita> $citas
 * @property-read int|null $citas_count
 * @property-read \App\Models\Ciudad|null $ciudad
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConsultorioProfesional> $consultorios
 * @property-read int|null $consultorios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactoAdminProfesional> $contactos
 * @property-read int|null $contactos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentoProfesional> $documentos
 * @property-read int|null $documentos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EspecializacionesProfesional> $especializaciones
 * @property-read int|null $especializaciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExperienciaLaboral> $experienciasLaborales
 * @property-read int|null $experiencias_laborales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormacionAdicional> $formacionesAdicionales
 * @property-read int|null $formaciones_adicionales_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\HorarioProfesional> $horarios
 * @property-read int|null $horarios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MetodoPago> $metodosPago
 * @property-read int|null $metodos_pago_count
 * @property-read \App\Models\Plan|null $plan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RespuestaExperto> $respuestasExpertos
 * @property-read int|null $respuestas_expertos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SegurosMedicos> $segurosMedicos
 * @property-read int|null $seguros_medicos_count
 * @property-read \App\Models\SuscripcionPlan|null $suscripcion
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SuscripcionPlan> $suscripciones
 * @property-read int|null $suscripciones_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TituloUniversitario> $titulosUniversitarios
 * @property-read int|null $titulos_universitarios_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Valoracion> $valoraciones
 * @property-read int|null $valoraciones_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereAniosExperiencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereCedulaIdentidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereCiudadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereDescripcionProfesional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereFirma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereIdiomas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereLicenciaMedica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereNombreCompleto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereNumColegiado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereNumeroCuenta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional wherePresencial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereSello($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereTelefonoPersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereTelefonoProfesional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Profesional whereVideoconsulta($value)
 */
	class Profesional extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $fecha_nacimiento
 * @property string|null $genero
 * @property string|null $telefono_personal
 * @property string|null $cedula_identidad
 * @property string|null $telefono_profesional
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Proveedor|null $proveedor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Proveedor> $proveedores
 * @property-read int|null $proveedores_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereCedulaIdentidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereGenero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereTelefonoPersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereTelefonoProfesional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Propietario whereUpdatedAt($value)
 */
	class Propietario extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $plan_id
 * @property string $tipo
 * @property string $nombre
 * @property string $ciudad
 * @property string $direccion
 * @property string|null $clinica_edificio
 * @property string $numero_identificacion
 * @property string $email
 * @property string $telefono
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $foto
 * @property int|null $propietario_id
 * @property string|null $especializacion
 * @property string|null $licencia
 * @property string|null $direccion_maps
 * @property string|null $imagenes
 * @property string|null $imagen_corporativa
 * @property string|null $informacion_adicional
 * @property string|null $listado_servicios
 * @property string|null $horarios
 * @property int|null $seguros_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContactoAdminProveedores> $contactos
 * @property-read int|null $contactos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentosProveedor> $documentos
 * @property-read int|null $documentos_count
 * @property-read \App\Models\Plan|null $plan
 * @property-read \App\Models\Propietario|null $propietario
 * @property-read \App\Models\SegurosMedicos|null $seguros
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SegurosMedicos> $segurosMedicos
 * @property-read int|null $seguros_medicos_count
 * @property-read \App\Models\SuscripcionesPlanesProveedores|null $suscripciones
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ValoracionProveedor> $valoraciones
 * @property-read int|null $valoraciones_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereCiudad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereClinicaEdificio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereDireccionMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereEspecializacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereHorarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereImagenCorporativa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereImagenes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereInformacionAdicional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereLicencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereListadoServicios($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereNumeroIdentificacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor wherePropietarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereSegurosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Proveedor whereUserId($value)
 */
	class Proveedor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $region_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Region $region
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Provincia whereUpdatedAt($value)
 */
	class Provincia extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $pedido_imagen_id
 * @property int|null $pedido_laboratorio_id
 * @property string|null $tipo
 * @property string|null $muestras
 * @property string|null $indicaciones
 * @property string|null $region_anatomica
 * @property string $prioridad
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PedidoImagen|null $pedidoImagen
 * @property-read \App\Models\PedidoLaboratorio|null $pedidoLaboratorio
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PresupuestoPrueba> $presupuestos
 * @property-read int|null $presupuestos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereIndicaciones($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereMuestras($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba wherePedidoImagenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba wherePedidoLaboratorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba wherePrioridad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereRegionAnatomica($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Prueba whereUpdatedAt($value)
 */
	class Prueba extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $informe_consulta_id
 * @property string|null $qr
 * @property string $fecha_emision
 * @property string|null $diagnostico
 * @property string|null $comentarios
 * @property string|null $ruta_firma
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\InformeConsulta $informeConsulta
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MedicamentoReceta> $medicamentosRecetados
 * @property-read int|null $medicamentos_recetados_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecetasAnteriores> $recetasAnteriores
 * @property-read int|null $recetas_anteriores_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecetasAnteriores> $recetas_anteriores
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereComentarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereDiagnostico($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereFechaEmision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereInformeConsultaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereRutaFirma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Receta whereUpdatedAt($value)
 */
	class Receta extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $receta_id
 * @property string|null $ruta_archivo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Receta $receta
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores whereRecetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores whereRutaArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RecetasAnteriores whereUpdatedAt($value)
 */
	class RecetasAnteriores extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereUpdatedAt($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $preguntas_expertos_id
 * @property string $respuesta
 * @property int|null $profesional_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PreguntaExperto|null $pregunta
 * @property-read \App\Models\Profesional|null $profesional
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto wherePreguntasExpertosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto whereRespuesta($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RespuestaExperto whereUpdatedAt($value)
 */
	class RespuestaExperto extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SegurosMedicos whereUpdatedAt($value)
 */
	class SegurosMedicos extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property int $plan_id
 * @property string $fecha_inicio
 * @property string|null $fecha_fin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $pagado
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\Profesional $profesional
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan wherePagado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionPlan whereUpdatedAt($value)
 */
	class SuscripcionPlan extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $proveedores_id
 * @property int $plan_id
 * @property string $fecha_inicio
 * @property string|null $fecha_fin
 * @property bool $pagado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\Proveedor $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores whereFechaFin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores wherePagado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores whereProveedoresId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SuscripcionesPlanesProveedores whereUpdatedAt($value)
 */
	class SuscripcionesPlanesProveedores extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $profesional_id
 * @property string $nombre
 * @property string $centro_educativo
 * @property string $pais
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario whereCentroEducativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario wherePais($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TituloUniversitario whereUpdatedAt($value)
 */
	class TituloUniversitario extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $role
 * @property int|null $activo
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Paciente|null $paciente
 * @property-read \App\Models\Profesional|null $profesional
 * @property-read \App\Models\Proveedor|null $proveedor
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $paciente_id
 * @property int $profesional_id
 * @property string $fecha
 * @property string $modalidad
 * @property int $puntuacion
 * @property string|null $comentario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Paciente $paciente
 * @property-read \App\Models\Profesional $profesional
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereModalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereProfesionalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion wherePuntuacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Valoracion whereUpdatedAt($value)
 */
	class Valoracion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $paciente_id
 * @property int $proveedor_id
 * @property string $fecha
 * @property string $modalidad
 * @property int $puntuacion
 * @property string|null $comentario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Paciente $paciente
 * @property-read \App\Models\Proveedor $proveedor
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereComentario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereModalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor wherePacienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereProveedorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor wherePuntuacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ValoracionProveedor whereUpdatedAt($value)
 */
	class ValoracionProveedor extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ViaAdministracionMedicamento whereUpdatedAt($value)
 */
	class ViaAdministracionMedicamento extends \Eloquent {}
}

