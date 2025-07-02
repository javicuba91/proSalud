<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticuloBlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriaBlogController;
use App\Http\Controllers\CategoriasProfesionalesController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\DocumentoProfesionalController;
use App\Http\Controllers\EmergenciaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\EtiquetaBlogController;
use App\Http\Controllers\InformeConsultaController;
use App\Http\Controllers\IntervaloMedicamentoController;
use App\Http\Controllers\MedicamentosRecetaController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PacienteFrontendController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\PresentacionMedicamentoController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ProfesionalFrontendController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorFrontendController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\SeguroMedicoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ValoracionController;
use App\Http\Controllers\ViaMedicamentoController;
use App\Models\Provincia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\MailTestController;

Auth::routes(['verify' => true]);

Route::get('/', [PacienteFrontendController::class, 'index'])->name('pacientes.index');


Route::get('/check-auth', function () {
    return response()->json(['authenticated' => Auth::check()]);
});

Route::post('/ajax-login', [LoginController::class, 'ajaxLogin'])->name('ajax.login');

Route::get('/cerrar-sesion', function () {
    Auth::logout();
    return redirect('/pacientes');
});

Route::middleware(['auth'])->group(function () {

    /* Cargar documento con medicamentos */
    Route::get('/admin/cargar-medicamentos', [AdminController::class, 'cargarMedicamentos'])->name('admin.cargarMedicamentos');

    /* URLS SIDEBAR: PACIENTE*/
    Route::get('/paciente', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::get('/paciente/pedir-cita', [PacienteController::class, 'pedirCita'])->name('pacientes.pedirCita');

    Route::get('/paciente/mis-citas', [PacienteController::class, 'misCitas'])->name('pacientes.misCitas');
    Route::get('/paciente/mis-citas/pendientes', [PacienteController::class, 'misCitasPendiente'])->name('pacientes.misCitas.pendiente');
    Route::get('/paciente/mis-citas/canceladas', [PacienteController::class, 'misCitasCanceladas'])->name('pacientes.misCitas.canceladas');
    Route::get('/paciente/mis-citas/cancelar/{id}', [PacienteController::class, 'cancelar'])->name('pacientes.misCitas.cancelar');
    Route::get('/paciente/mis-citas/aceptadas', [PacienteController::class, 'misCitasAceptadas'])->name('pacientes.misCitas.aceptadas');
    Route::get('/paciente/mis-citas/{id}/detalle', [PacienteController::class, 'detalleCita'])->name('pacientes.misCitas.detalle');
    Route::post('/pacientes/valoraciones', [PacienteController::class, 'guardarValoracion'])->name('pacientes.valoraciones.store');


    Route::get('/paciente/buscar-profesionales', [PacienteController::class, 'buscarProfesionales'])->name('pacientes.buscarProfesionales');
    Route::get('/paciente/buscar-profesionales/categoria/{id}/citas', [PacienteController::class, 'buscarProfesionalesCitas'])->name('pacientes.buscarProfesionales');
    Route::get('/paciente/buscar-proveedores', [PacienteController::class, 'buscarProveedores'])->name('pacientes.buscarProveedores');
    Route::get('/paciente/buscar-proveedores/presupuestos', [PacienteController::class, 'buscarProveedoresPresupuestos'])->name('pacientes.buscarProveedores');
    Route::get('/paciente/buscar-emergencias', [PacienteController::class, 'buscarEmergencias'])->name('pacientes.buscarEmergencias');

    Route::get('/paciente/emergencias', [PacienteController::class, 'emergencias'])->name('pacientes.emergencias');
    Route::get('/paciente/mis-recetas', [PacienteController::class, 'misRecetas'])->name('pacientes.misRecetas');
    Route::get('/paciente/mis-recetas/detalle/{id}', [PacienteController::class, 'misRecetasDetalle'])->name('pacientes.misRecetas.detalle');
    Route::get('/paciente/presupuestos', [PacienteController::class, 'presupuestos'])->name('pacientes.presupuestos');
    Route::get('/paciente/mis-pruebas', [PacienteController::class, 'misPruebas'])->name('pacientes.misPruebas');
    Route::get('/paciente/mi-historial-medico', [PacienteController::class, 'miHistorialMedico'])->name(name: 'pacientes.miHistorialMedico');

    Route::get('/paciente/mis-valoraciones', [PacienteController::class, 'valoraciones'])->name('pacientes.valoraciones');
    Route::get('/paciente/mis-valoraciones/detalle/profesionales/{id}', [PacienteController::class, 'valoracionesProfesionales'])->name('pacientes.valoraciones.profesionales');
    Route::get('/paciente/mis-valoraciones/detalle/proveedores/{id}', [PacienteController::class, 'valoracionesProveedores'])->name('pacientes.valoraciones.proveedores');

    Route::get('/paciente/mis-datos', [PacienteController::class, 'datos'])->name('pacientes.datos');
    Route::get('/paciente/notificaciones', [PacienteController::class, 'notificaciones'])->name('pacientes.notificaciones');
    Route::get('/paciente/contactar-administrador', [PacienteController::class, 'contactoAdministrador'])->name('pacientes.contactoAdministrador');

    Route::get('/paciente/cita/informe-consulta/{id}/receta', [PacienteController::class, 'misRecetasDetalle'])->name('profesionales.informeConsulta.receta');

    Route::get('/subespecialidades/{id}', [PacienteController::class, 'getSubespecialidades']);


    Route::put('/paciente/{paciente}', [PacienteController::class, 'update'])->name('paciente.update');

    Route::delete('/paciente/antecedentes/{antecedente}', [PacienteController::class, 'eliminarAntecdente'])->name('paciente.antecedentes.destroy');
    Route::delete('/paciente/contactos/{contacto}', [PacienteController::class, 'eliminarContacto'])->name('paciente.contactos.destroy');

    Route::post('/paciente/usuario/eliminar-cuenta', [PacienteController::class, 'eliminarCuenta'])->name('usuario.eliminarCuenta');



    /* URLS SIDEBAR: PROFESIONAL*/
    // Rutas SIEMPRE accesibles para el profesional
    Route::get('/profesional', [ProfesionalController::class, 'index'])->name('profesionales.index');
    Route::get('/profesional/mis-estadisticas', [ProfesionalController::class, 'misEstadisticas'])->name('profesionales.misEstadisticas');
    Route::get('/profesional/mis-datos', [ProfesionalController::class, 'misDatos'])->name('profesionales.misDatos');
    Route::get('/profesional/mis-planes', [ProfesionalController::class, 'misPlanes'])->name('profesionales.misPlanes');
    Route::get('/profesional/contactar-administrador', [ProfesionalController::class, 'contactarAdministrador'])->name('profesionales.contactarAdministrador');

    // Rutas para preguntas y respuestas de expertos
    Route::get('/profesional/preguntas-respuestas', [ProfesionalController::class, 'preguntasRespuestas'])->name('profesionales.preguntasRespuestas');
    Route::post('/profesional/responder-pregunta', [ProfesionalController::class, 'responderPregunta'])->name('profesionales.responderPregunta');

    Route::post('/profesional/elegir-plan', [ProfesionalController::class, 'elegirPlan'])->name('profesional.elegir.plan');
    Route::post('/profesional/pagar-plan', [ProfesionalController::class, 'pagarPlan'])->name('profesional.pagar.plan');

    Route::get('/api/profesional/horarios', [ProfesionalController::class, 'eventosCalendario']);
    Route::get('/api/profesional/horarios/{fecha}', [ProfesionalController::class, 'horariosPorDia']);
    Route::delete('/profesional/detalle-horarios/{id}', [ProfesionalController::class, 'eliminarDetalle']);

     Route::get('/api/profesional/horarios-videollamada', [ProfesionalController::class, 'eventosCalendarioVideollamada']);
    Route::get('/api/profesional/horarios-videollamada/{fecha}', [ProfesionalController::class, 'horariosPorDiaVideollamada']);
    Route::delete('/profesional/detalle-horarios-videollamada/{id}', [ProfesionalController::class, 'eliminarDetalleVideollamada']);



        /* Eliminar título universitario */
        Route::delete('/profesional/titulo-universitario/{id}', [ProfesionalController::class, 'eliminarTitulo'])->name('profesional.titulo.delete');
        Route::delete('/profesional/especializacion/{id}', [ProfesionalController::class, 'eliminarEspecializacion']);
        Route::delete('/profesional/formacion-adicional/{id}', [ProfesionalController::class, 'eliminarFormacion']);
        Route::delete('/profesional/experiencia/{id}', [ProfesionalController::class, 'eliminarExperiencia']);
        Route::delete('/profesional/consultorios/{id}', [ProfesionalController::class, 'eliminarConsultorio']);
        Route::post('/profesional/guardar-seguro', [ProfesionalController::class, 'guardarSeguro']);
        Route::post('/profesional/eliminar-seguro', [ProfesionalController::class, 'eliminarSeguro']);
        Route::post('/profesional/actualizar-numero-cuenta', [ProfesionalController::class, 'actualizarNumeroCuenta']);
        Route::post('/profesional/actualizar-datos', [ProfesionalController::class, 'actualizarDatos']);
        Route::post('/profesional/actualizar-contrasena', [ProfesionalController::class, 'actualizarContrasena'])->name('profesional.actualizarContrasena');
        Route::post('/profesional/titulos-universitarios', [ProfesionalController::class, 'guardarTitulo'])->name('profesional.titulos.guardar');
        Route::post('/profesional/especializaciones/guardar', [ProfesionalController::class, 'guardarEspecializacion'])
            ->name('profesional.especializaciones.guardar');
        Route::post('/profesional/formaciones-adicionales/guardar', [ProfesionalController::class, 'guardarFormacionAdicional'])
            ->name('profesional.formaciones-adicionales.guardar');
        Route::post('/profesional/experiencias/guardar', [ProfesionalController::class, 'guardarExperiencia'])
            ->name('profesional.experiencias.guardar');
        Route::post('/profesional/consultorios/guardar', [ProfesionalController::class, 'guardarConsultorio'])
            ->name('profesional.consultorios.guardar');
        Route::post('/profesional/citas/cancelar/{id}', [ProfesionalController::class, 'cancelar']);

        Route::put('/profesional/{profesional}/metodos-pago', [ProfesionalController::class, 'updateMetodosPago'])
            ->name('profesional.metodos_pago.update');

        Route::post('/profesional/guardar-horarios', [ProfesionalController::class, 'guardarHorariosPresencial'])->name('profesional.horarios.presencial.guardar');
        Route::post('/profesional/guardar-horarios-videollamada', [ProfesionalController::class, 'guardarHorariosVideollamada'])->name('profesional.horarios.videollamada.guardar');

        Route::post('/profesional/consultorio/{id}/imagenes', [ProfesionalController::class, 'guardarImagenesConsultorio'])->name('profesional.consultorio.imagenes.store');
        Route::get('/profesional/consultorio/{id}/imagenes', [ProfesionalController::class, 'listaImagenesConsultorio'])->name('profesional.consultorio.imagenes.index');
        Route::delete('/profesional/consultorio/imagen/{id}', [ProfesionalController::class, 'eliminarImagenConsultorio']);

        Route::post('/profesional/{id}/documentos', [ProfesionalController::class, 'guardarDocumento'])->name('profesionales.documentos.store');
        Route::delete('/profesional/documentos/{documento}', [ProfesionalController::class, 'eliminarDocumento'])->name('profesionales.documentos.destroy');


        Route::get('/get-provincias/{region_id}', [ProfesionalController::class, 'getProvincias']);
        Route::get('/get-ciudades/{provincia_id}', [ProfesionalController::class, 'getCiudades']);

    // Agrupa el resto de rutas bajo el middleware de suscripción pagada
    Route::middleware(['suscripcion.pagada'])->group(function () {
        Route::get('/profesional/mis-citas-presenciales', [ProfesionalController::class, 'misCitasPresenciales'])->name('profesionales.misCitasPresenciales');
        Route::get('/profesional/mis-citas-presenciales/pendientes', [ProfesionalController::class, 'misCitasPresencialesPendientes'])->name('profesionales.misCitasPresencialesPendientes');
        Route::get('/profesional/listado-citas-presenciales', [ProfesionalController::class, 'listadoCitasPresenciales'])->name('profesional.listadoCitasPresenciales');
        Route::get('/profesional/mis-citas-videoconsulta', [ProfesionalController::class, 'misCitasVideoconsulta'])->name('profesionales.misCitasVideoconsulta');
        Route::get('/profesional/mis-citas-videoconsulta/pendientes', [ProfesionalController::class, 'misCitasVideoconsultaPendientes'])->name('profesionales.misCitasVideoconsultaPendientes');
        Route::get('/profesional/mis-pacientes', [ProfesionalController::class, 'misPacientes'])->name('profesionales.misPacientes');
        Route::get('/profesional/mis-pacientes/edit/{id}', [ProfesionalController::class, 'editPacientes'])->name('profesionales.editPacientes');
        Route::put('/profesional/mis-pacientes/update/{id}', [ProfesionalController::class, 'updatePacientes'])->name('profesionales.updatePacientes');
        Route::get('/profesional/listado-citas-videollamada', [ProfesionalController::class, 'listadoCitasVideollamada'])->name('profesional.listadoCitasVideollamada');


        Route::get('/profesional/recetas-farmacia-digitales', [ProfesionalController::class, 'recetasFarmacia'])->name('profesionales.recetasFarmacia');
        Route::get('/profesional/recetas-farmacia-digitales/crear', [ProfesionalController::class, 'recetasFarmaciaCrear'])->name('profesionales.recetasFarmaciaCrear');

        Route::get('/profesional/pedidos-laboratorio', [ProfesionalController::class, 'pedidosLaboratorio'])->name('profesionales.pedidosLaboratorio');
        Route::get('/profesional/pedidos-laboratorio/crear', [ProfesionalController::class, 'pedidosLaboratorioCrear'])->name('profesionales.pedidosLaboratorioCrear');

        Route::get('/profesional/pedidos-imagenes', [ProfesionalController::class, 'pedidosImagenes'])->name('profesionales.pedidosImagenes');
        Route::get('/profesional/pedidos-imagenes/crear', [ProfesionalController::class, 'pedidosImagenesCrear'])->name('profesionales.pedidosImagenesCrear');

        Route::get('/profesional/valoraciones-comentarios', [ProfesionalController::class, 'valoracionesComentarios'])->name('profesionales.valoracionesComentarios');
        Route::get('/profesional/notificaciones', [ProfesionalController::class, 'notificaciones'])->name('profesionales.notificaciones');
        Route::get('/profesional/mis-citas/agendar', [ProfesionalController::class, 'agendarCitaProfesional'])->name('profesionales.agendarCitaProfesional');
        Route::get('/profesional/mis-pacientes/historial/{id}', [ProfesionalController::class, 'historialClinicoPaciente'])->name('profesionales.historialClinicoPaciente');
        Route::get('/profesional/paciente/crear', [ProfesionalController::class, 'crearPaciente'])->name('profesionales.crearPaciente');
        Route::post('/profesional/paciente/guardar', [ProfesionalController::class, 'guardarPaciente'])->name('profesionales.guardarPaciente');


        Route::get('/profesional/cita/informe-consulta/{id}', [ProfesionalController::class, 'informeConsulta'])->name('profesionales.informeConsulta');
        Route::post('/pacientes/cita/informe-consulta/{id}', [ProfesionalController::class, 'informeConsultaCrear'])->name('profesionales.informeConsultaCrear');
        Route::get('/profesional/cita/informe-consulta/{id}/receta', [ProfesionalController::class, 'recetaInformeConsulta'])->name('profesionales.informeConsulta.receta');
        Route::post('/profesional/medicamentos-recetas', [MedicamentosRecetaController::class, 'store'])->name('profesionales.medicamentos_recetas.guardarMedicamentosReceta');
        Route::delete('/profesional/medicamentos_recetas/{id}', [MedicamentosRecetaController::class, 'destroy'])->name('profesionales.medicamentos_recetas.destroy');
        Route::post('/profesional/receta/guardar/{id}', [ProfesionalController::class, 'actualizarReceta'])->name('profesionales.receta.update');
        Route::get('/profesional/receta/detalle/{id}', [ProfesionalController::class, 'detalleReceta'])->name('profesionales.detalleReceta');

        Route::get('/profesional/listado-citas-presenciales/aceptadas', [ProfesionalController::class, 'listadoCitasPresencialesAceptadas'])->name('profesional.listadoCitasPresencialesAceptadas');
        Route::get('/profesional/listado-citas-presenciales/pasadas', [ProfesionalController::class, 'listadoCitasPresencialesPasadas'])->name('profesional.listadoCitasPresencialesPasadas');


        Route::post('/profesional/contactos', [ProfesionalController::class, 'realizarContactoAdministrador'])->name('profesional.contactos.store');

        Route::get('/profesional/pacientes/buscar', [ProfesionalController::class, 'buscarPaciente'])->name('profesional.pacientes.buscar');
        Route::get('/profesional/consultorios/buscar', [ProfesionalController::class, 'delProfesional'])->name('profesional.consultorios.buscar');

        Route::post('/profesional/citas/guardar', [ProfesionalController::class, 'guardarCita'])->name('profesional.citas.guardar');

        Route::get('/profesional/citas/presenciales/json', [ProfesionalController::class, 'citasPresencialesJson'])->name('profesional.citasPresencialesJson');
        Route::get('/profesional/citas/videollamadas/json', [ProfesionalController::class, 'citasVideoLlamadasJson'])->name('profesional.citasVideoLlamadasJson');

        Route::post('/profesional/citas/actualizar-fecha', [ProfesionalController::class, 'actualizarFecha'])->name('profesional.citas.actualizarFecha');
        Route::post('/profesional/citas/enviar-recordatorio', [ProfesionalController::class, 'enviarRecordatorioCita'])->name('profesional.citas.enviarRecordatorio');


        Route::get('/profesional/recetas/{id}/exportar-pdf', [ProfesionalController::class, 'exportarRecetaPDF'])->name('profesional.receta.exportarPDF');


        /* URLS SIDEBAR: Proveedor*/
        Route::get('/proveedor', [ProveedorController::class, 'index'])->name('proveedores.index');
        Route::get('/proveedor/mis-estadisticas', [ProveedorController::class, 'misEstadisticas'])->name('proveedores.misEstadisticas');
        Route::get('/proveedor/contactar-administrador', [ProveedorController::class, 'contactarAdministrador'])->name('proveedores.contactarAdministrador');
        Route::get('/proveedor/notificaciones', [ProveedorController::class, 'notificaciones'])->name('proveedores.notificaciones');
        Route::get('/proveedor/mis-planes', [ProveedorController::class, 'misPlanes'])->name('proveedores.misPlanes');
        Route::get('/proveedor/mis-valoraciones', [ProveedorController::class, 'valoracionesComentarios'])->name('proveedores.valoracionesComentarios');
        Route::get('/proveedor/compartir-resultado', [ProveedorController::class, 'compartirResultados'])->name('proveedores.compartirResultados');
        Route::get('/proveedor/mis-datos', [ProveedorController::class, 'misDatos'])->name('proveedores.misDatos');
        Route::post('/proveedor/mis-datos', [ProveedorController::class, 'GuardarMisDatos'])->name('proveedores.guardarMisDatos');
        Route::post('/proveedor/mis-datos/guardar-documentos/{id}', [ProveedorController::class, 'guardarDocumento'])->name('proveedores.guardarDocumento');
        Route::delete('/proveedor/documentos/{documento}', [ProveedorController::class, 'eliminarDocumento'])->name('proveedores.documentos.destroy');
        Route::post('/proveedor/guardar-seguro', [ProveedorController::class, 'guardarSeguro'])->name('proveedores.guardarSeguro');
        Route::post('/proveedor/eliminar-seguro', [ProveedorController::class, 'eliminarSeguro'])->name('proveedores.eliminarSeguro');
        Route::get('/proveedor/mis-citas', [ProveedorController::class, 'misCitas'])->name('proveedores.misCitas');

        Route::get('/proveedor/listado-citas/pasadas', [ProveedorController::class, 'listadoCitasPasadas'])->name('proveedores.listadoCitasPasadas');
        Route::get('/proveedor/listado-citas/aceptadas', [ProveedorController::class, 'listadoCitasAceptadas'])->name('proveedores.listadoCitasAceptadas');
        Route::get('/proveedor/listado-citas/pendientes', [ProveedorController::class, 'listadoCitasPendientes'])->name('proveedores.listadoCitasPendientes');
        Route::get('/proveedor/mis-citas/agendar', [ProveedorController::class, 'agendarCitaProveedor'])->name('profesionales.agendarCitaProveedor');
        Route::get('/proveedor/mis-clientes-pacientes', [ProveedorController::class, 'misClinicasPacientes'])->name('profesionales.misClinicasPacientes');
        Route::get('/proveedor/historial-pruebas', [ProveedorController::class, 'historialPruebas'])->name('profesionales.historialPruebas');
    });
});



Route::get('/profesionales', [ProfesionalFrontendController::class, 'index'])->name('profesionales.index');
Route::post('/profesionales/registrar', [ProfesionalFrontendController::class, 'registroProfesional'])->name('profesionales.registroProfesional');

Route::get('/profesionales/beneficios', [ProfesionalFrontendController::class, 'beneficios'])->name('profesionales.beneficios');
Route::get('/profesionales/funcionalidades', [ProfesionalFrontendController::class, 'funcionalidades'])->name('profesionales.funcionalidades');
Route::get('/profesionales/planes', [ProfesionalFrontendController::class, 'planes'])->name('profesionales.planes');
Route::get('/profesionales/login', [ProfesionalFrontendController::class, 'login'])->name('profesionales.login');
Route::get('/profesionales/registro', [ProfesionalFrontendController::class, 'registro'])->name('profesionales.registro');
Route::get('/profesionales/contacto', [ProfesionalFrontendController::class, 'contacto'])->name('profesionales.contacto');
Route::get('/profesionales/ficha/{id}', [ProfesionalFrontendController::class, 'detalleProfesional'])->name('profesionales.detalleProfesional');


Route::get('/proveedores', [ProveedorFrontendController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/beneficios', [ProveedorFrontendController::class, 'beneficios'])->name('proveedores.beneficios');
Route::get('/proveedores/funcionalidades', [ProveedorFrontendController::class, 'funcionalidades'])->name('proveedores.funcionalidades');
Route::get('/proveedores/planes', [ProveedorFrontendController::class, 'planes'])->name('proveedores.planes');
Route::get('/proveedores/login', [ProveedorFrontendController::class, 'login'])->name('proveedores.login');
Route::get('/proveedores/registro', [ProveedorFrontendController::class, 'registro'])->name('proveedores.registro');
Route::get('/proveedores/contacto', [ProveedorFrontendController::class, 'contacto'])->name('proveedores.contacto');
Route::post('/proveedores/registrar', [ProveedorFrontendController::class, 'registroProveedor'])->name('proveedores.registroProveedor');

Route::get('/pacientes', [PacienteFrontendController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes/registro', [PacienteFrontendController::class, 'registro'])->name('pacientes.registro');
Route::post('/pacientes/registrar', [PacienteFrontendController::class, 'registroPaciente'])->name('pacientes.registroPaciente');
Route::get('/pacientes/contacto', [PacienteFrontendController::class, 'contacto'])->name('pacientes.contacto');
Route::get('/pacientes/login', [PacienteFrontendController::class, 'login'])->name('pacientes.login');
Route::get('/pacientes/preguntas-expertos', [PacienteFrontendController::class, 'preguntasExpertos'])->name('pacientes.preguntasExpertos');
Route::post('/profesionales/preguntas-expertos', [PacienteFrontendController::class, 'preguntasExpertosGuardar'])->name('pacientes.enviar.preguntasExpertos');
Route::get('/pacientes/preguntas-expertos/filtros', [PacienteFrontendController::class, 'pacientePreguntaRespuestaFiltro'])->name('pacientes.respuestas.index');
Route::get('/pacientes/citas/{id}/resumen', [PacienteFrontendController::class, 'resumenCita'])->name('pacientes.citas.resumen');
Route::post('/pacientes/citas/pago/{id}', [PacienteFrontendController::class, 'simularPago'])->name('pacientes.citas.pago');
Route::get('/pacientes/blog', [PacienteFrontendController::class, 'blog'])->name('pacientes.blog');
Route::get('/pacientes/blog/{slug}', [PacienteFrontendController::class, 'detalleBlog'])->name('blog.detalle');

Route::get('/pacientes/ayuda', [PacienteFrontendController::class, 'ayuda'])->name('pacientes.ayuda');

/* Buscadores por Categorías */
Route::get('/pacientes/buscar/medicos', [PacienteFrontendController::class, 'buscarMedicosPaciente'])->name('pacientes.buscar.medicos');
Route::get('/pacientes/buscar/emergencias', [PacienteFrontendController::class, 'buscarEmergenciasPaciente'])->name('pacientes.buscar.emergencias');


Route::get('/api/frontend/profesional/horarios/{id}', [PacienteFrontendController::class, 'eventosCalendarioProfesional']);
Route::get('/api/frontend/profesional/horarios/{id}/{fecha}', [PacienteFrontendController::class, 'horariosPorDiaProfesional']);

Route::get('/api/frontend/profesional/horarios-videollamada/{id}', [PacienteFrontendController::class, 'eventosCalendarioProfesionalVideollamada']);
Route::get('/api/frontend/profesional/horarios-videollamada/{id}/{fecha}', [PacienteFrontendController::class, 'horariosPorDiaProfesionalVideollamada']);


Route::post('/citas/ajax', [PacienteFrontendController::class, 'storeAjax'])->name('citas.ajax.store');

Route::post('/citas/videollamadas/ajax', [PacienteFrontendController::class, 'storeAjaxVideollamada'])->name('citas.videollamada.ajax.store');

/* Misceláneas */
Route::get('/subespecialidades/{id}', [PacienteController::class, 'getSubespecialidades']);
Route::get('/get-provincias/{region_id}', [ProfesionalController::class, 'getProvincias']);
Route::get('/get-ciudades/{provincia_id}', [ProfesionalController::class, 'getCiudades']);





/* RUTAS ADMINISTRADOR */

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Aquí todas tus rutas de admin
        Route::get('/', [AdminController::class, 'index']);

        Route::get('/facturacion', [FacturacionController::class, 'index'])->name('admin.facturacion.index');
        Route::get('/facturacion/{id}', [FacturacionController::class, 'show'])->name('admin.facturacion.show');
        Route::get('/facturacion/{id}/pagar', [FacturacionController::class, 'pagar'])->name('admin.facturacion.pagar');
        Route::post('/facturacion/{id}/pagar', [FacturacionController::class, 'pagarPost'])->name('admin.facturacion.pagar.post');

        Route::get('/especialidades', [EspecialidadController::class, 'index'])->name('especialidades.index');
        Route::get('/especialidades/create', [EspecialidadController::class, 'create'])->name('especialidades.create');
        Route::post('/especialidades', [EspecialidadController::class, 'store'])->name('especialidades.store');
        Route::get('/especialidades/{especialidad}/edit', [EspecialidadController::class, 'edit'])->name('especialidades.edit');
        Route::put('/especialidades/{especialidad}', [EspecialidadController::class, 'update'])->name('especialidades.update');
        Route::delete('/especialidades/{especialidad}', [EspecialidadController::class, 'destroy'])->name('especialidades.destroy');

        Route::get('/categorias-profesionales', [CategoriasProfesionalesController::class, 'index'])->name('categorias-profesionales.index');
        Route::get('/categorias-profesionales/create', [CategoriasProfesionalesController::class, 'create'])->name('categorias-profesionales.create');
        Route::post('/categorias-profesionales', [CategoriasProfesionalesController::class, 'store'])->name('categorias-profesionales.store');
        Route::get('/categorias-profesionales/{categoriaProfesional}/edit', [CategoriasProfesionalesController::class, 'edit'])->name('categorias-profesionales.edit');
        Route::put('/categorias-profesionales/{categoriaProfesional}', [CategoriasProfesionalesController::class, 'update'])->name('categorias-profesionales.update');
        Route::delete('/categorias-profesionales/{categoriaProfesional}', [CategoriasProfesionalesController::class, 'destroy'])->name('categorias-profesionales.destroy');

        Route::get('/metodos-pago', [MetodoPagoController::class, 'index'])->name('metodos-pagos.index');
        Route::get('/metodos-pago/create', [MetodoPagoController::class, 'create'])->name('metodos-pagos.create');
        Route::post('/metodos-pago', [MetodoPagoController::class, 'store'])->name('metodos-pagos.store');
        Route::get('/metodos-pago/{metodo}/edit', [MetodoPagoController::class, 'edit'])->name('metodos-pagos.edit');
        Route::put('/metodos-pago/{metodo}', [MetodoPagoController::class, 'update'])->name('metodos-pagos.update');
        Route::delete('/metodos-pago/{metodo}', [MetodoPagoController::class, 'destroy'])->name('metodos-pagos.destroy');

        Route::get('/planes', [PlanController::class, 'index'])->name('planes.index');
        Route::get('/planes/create', [PlanController::class, 'create'])->name('planes.create');
        Route::post('/planes', [PlanController::class, 'store'])->name('planes.store');
        Route::get('/planes/{plan}/edit', [PlanController::class, 'edit'])->name('planes.edit');
        Route::put('/planes/{plan}', [PlanController::class, 'update'])->name('planes.update');
        Route::delete('/planes/{plan}', [PlanController::class, 'destroy'])->name('planes.destroy');
        Route::get('/planes/{plan}', [PlanController::class, 'show'])->name('planes.show');

        Route::get('/seguros-medicos', [SeguroMedicoController::class, 'index'])->name('seguros_medicos.index');
        Route::get('/seguros-medicos/create', [SeguroMedicoController::class, 'create'])->name('seguros_medicos.create');
        Route::post('/seguros-medicos', [SeguroMedicoController::class, 'store'])->name('seguros_medicos.store');
        Route::get('/seguros-medicos/{seguro}/edit', [SeguroMedicoController::class, 'edit'])->name('seguros_medicos.edit');
        Route::put('/seguros-medicos/{seguro}', [SeguroMedicoController::class, 'update'])->name('seguros_medicos.update');
        Route::delete('/seguros-medicos/{seguro}', [SeguroMedicoController::class, 'destroy'])->name('seguros_medicos.destroy');

        Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
        Route::get('/citas/{cita}', [CitaController::class, 'show'])->name('citas.show');
        Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
        Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
        Route::get('/citas/{cita}/edit', [CitaController::class, 'edit'])->name('citas.edit');
        Route::put('/citas/{cita}', [CitaController::class, 'update'])->name('citas.update');
        Route::delete('/citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');

        Route::post('/citas/{cita}/cancelar', [CitaController::class, 'cancelar'])->name('citas.cancelar');

        Route::get('/citas/profesional/{id}', [CitaController::class, 'especializacionesProfesional'])
            ->name('citas.especializaciones.profesional');
        Route::get('/citas/profesional/{id}/modalidades', [CitaController::class, 'modalidadesProfesional'])
            ->name('citas.modalidades.profesional');
        Route::get('/citas/profesional/{id}/consultorios', [CitaController::class, 'consultoriosProfesional'])
            ->name('citas.consultorios.profesional');

        Route::get('/emergencias', [EmergenciaController::class, 'index'])->name('emergencias.index');
        Route::get('/emergencias/create', [EmergenciaController::class, 'create'])->name('emergencias.create');
        Route::post('/emergencias', [EmergenciaController::class, 'store'])->name('emergencias.store');
        Route::get('/emergencias/{emergencia}/edit', [EmergenciaController::class, 'edit'])->name('emergencias.edit');
        Route::put('/emergencias/{emergencia}', [EmergenciaController::class, 'update'])->name('emergencias.update');
        Route::delete('/emergencias/{emergencia}', [EmergenciaController::class, 'destroy'])->name('emergencias.destroy');

        Route::get('/medicamentos', [MedicamentoController::class, 'index'])->name('medicamentos.index');
        Route::get('/medicamentos/create', [MedicamentoController::class, 'create'])->name('medicamentos.create');
        Route::post('/medicamentos', [MedicamentoController::class, 'store'])->name('medicamentos.store');
        Route::get('/medicamentos/{medicamento}/edit', [MedicamentoController::class, 'edit'])->name('medicamentos.edit');
        Route::put('/medicamentos/{medicamento}', [MedicamentoController::class, 'update'])->name('medicamentos.update');
        Route::delete('/medicamentos/{medicamento}', [MedicamentoController::class, 'destroy'])->name('medicamentos.destroy');

        Route::get('/intervalo-medicamentos', [IntervaloMedicamentoController::class, 'index'])->name('intervalos.index');
        Route::get('/intervalo-medicamentos/create', [IntervaloMedicamentoController::class, 'create'])->name('intervalos.create');
        Route::post('/intervalo-medicamentos', [IntervaloMedicamentoController::class, 'store'])->name('intervalos.store');
        Route::get('/intervalo-medicamentos/{intervalo}/edit', [IntervaloMedicamentoController::class, 'edit'])->name('intervalos.edit');
        Route::put('/intervalo-medicamentos/{intervalo}', [IntervaloMedicamentoController::class, 'update'])->name('intervalos.update');
        Route::delete('/intervalo-medicamentos/{intervalo}', [IntervaloMedicamentoController::class, 'destroy'])->name('intervalos.destroy');

        Route::get('/presentacion-medicamentos', [PresentacionMedicamentoController::class, 'index'])->name('presentaciones.index');
        Route::get('/presentacion-medicamentos/create', [PresentacionMedicamentoController::class, 'create'])->name('presentaciones.create');
        Route::post('/presentacion-medicamentos', [PresentacionMedicamentoController::class, 'store'])->name('presentaciones.store');
        Route::get('/presentacion-medicamentos/{presentacion}/edit', [PresentacionMedicamentoController::class, 'edit'])->name('presentaciones.edit');
        Route::put('/presentacion-medicamentos/{presentacion}', [PresentacionMedicamentoController::class, 'update'])->name('presentaciones.update');
        Route::delete('/presentacion-medicamentos/{presentacion}', [PresentacionMedicamentoController::class, 'destroy'])->name('presentaciones.destroy');

        Route::get('/vias-administracion-medicamentos', [ViaMedicamentoController::class, 'index'])->name('vias.index');
        Route::get('/vias-administracion-medicamentos/create', [ViaMedicamentoController::class, 'create'])->name('vias.create');
        Route::post('/vias-administracion-medicamentos', [ViaMedicamentoController::class, 'store'])->name('vias.store');
        Route::get('/vias-administracion-medicamentos/{via}/edit', [ViaMedicamentoController::class, 'edit'])->name('vias.edit');
        Route::put('/vias-administracion-medicamentos/{via}', [ViaMedicamentoController::class, 'update'])->name('vias.update');
        Route::delete('/vias-administracion-medicamentos/{via}', [ViaMedicamentoController::class, 'destroy'])->name('vias.destroy');

        Route::get('/regiones', [RegionController::class, 'index'])->name('regiones.index');
        Route::get('/regiones/create', [RegionController::class, 'create'])->name('regiones.create');
        Route::post('/regiones', [RegionController::class, 'store'])->name('regiones.store');
        Route::get('/regiones/{region}/edit', [RegionController::class, 'edit'])->name('regiones.edit');
        Route::put('/regiones/{region}', [RegionController::class, 'update'])->name('regiones.update');
        Route::delete('/regiones/{region}', [RegionController::class, 'destroy'])->name('regiones.destroy');

        Route::get('/provincias', [ProvinciaController::class, 'index'])->name('provincias.index');
        Route::get('/provincias/create', [ProvinciaController::class, 'create'])->name('provincias.create');
        Route::post('/provincias', [ProvinciaController::class, 'store'])->name('provincias.store');
        Route::get('/provincias/{provincia}/edit', [ProvinciaController::class, 'edit'])->name('provincias.edit');
        Route::put('/provincias/{provincia}', [ProvinciaController::class, 'update'])->name('provincias.update');
        Route::delete('/provincias/{provincia}', [ProvinciaController::class, 'destroy'])->name('provincias.destroy');

        Route::get('/ciudades', [CiudadController::class, 'index'])->name('ciudades.index');
        Route::get('/ciudades/create', [CiudadController::class, 'create'])->name('ciudades.create');
        Route::post('/ciudades', [CiudadController::class, 'store'])->name('ciudades.store');
        Route::get('/ciudades/{ciudad}/edit', [CiudadController::class, 'edit'])->name('ciudades.edit');
        Route::put('/ciudades/{ciudad}', [CiudadController::class, 'update'])->name('ciudades.update');
        Route::delete('/ciudades/{ciudad}', [CiudadController::class, 'destroy'])->name('ciudades.destroy');

        // USUARIOS
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::get('/usuarios/show/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
        Route::get('/usuarios/{usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

        // Rutas adicionales para redirecciones por rol desde el controlador
        Route::get('/usuarios/pacientes', [UsuarioController::class, 'indexPaciente'])->name('usuarios.pacientes');
        Route::get('/usuarios/profesionales', [UsuarioController::class, 'indexProfesional'])->name('usuarios.profesionales');
        Route::get('/usuarios/proveedores', [UsuarioController::class, 'indexProveedor'])->name('usuarios.proveedores');
        Route::get('/usuarios/administradores', [UsuarioController::class, 'indexAdmin'])->name('usuarios.administradores');

        // ADMINISTRADORES
        Route::get('/administradores', [UsuarioController::class, 'indexAdmin'])->name('administradores.index');
        Route::get('/administradores/show/{id}', [UsuarioController::class, 'showAdmin'])->name('administradores.show');
        Route::get('/administradores/{id}/edit', [UsuarioController::class, 'editAdmin'])->name('administradores.edit');
        Route::put('/administradores/{id}', [UsuarioController::class, 'updateAdmin'])->name('administradores.update');

        // PACIENTES
        Route::get('/pacientes', [UsuarioController::class, 'indexPaciente'])->name('pacientes.index');
        Route::get('/pacientes/show/{id}', [UsuarioController::class, 'showPaciente'])->name('pacientes.show');
        Route::get('/pacientes/{id}/edit', [UsuarioController::class, 'editPaciente'])->name('pacientes.edit');
        Route::put('/pacientes/{id}', [UsuarioController::class, 'updatePaciente'])->name('pacientes.update');

        // PROFESIONALES
        Route::get('/profesionales', [UsuarioController::class, 'indexProfesional'])->name('profesionales.index');
        Route::get('/profesionales/show/{id}', [UsuarioController::class, 'showProfesional'])->name('profesionales.show');
        Route::get('/profesionales/{id}/edit', [UsuarioController::class, 'editProfesional'])->name('profesionales.edit');
        Route::put('/profesionales/{id}', [UsuarioController::class, 'updateProfesional'])->name('profesionales.update');

        // PROVEEDORES
        Route::get('/proveedores', [UsuarioController::class, 'indexProveedor'])->name('proveedores.index');
        Route::get('/proveedores/show/{id}', [UsuarioController::class, 'showProveedor'])->name('proveedores.show');
        Route::get('/proveedores/{id}/edit', [UsuarioController::class, 'editProveedor'])->name('proveedores.edit');
        Route::put('/proveedores/{id}', [UsuarioController::class, 'updateProveedor'])->name('proveedores.update');

        Route::get('/documentos-profesional', [DocumentoProfesionalController::class, 'index'])->name('documentos.index');
        Route::get('/documentos-profesional/create', [DocumentoProfesionalController::class, 'create'])->name('documentos.create');
        Route::post('/documentos-profesional', [DocumentoProfesionalController::class, 'store'])->name('documentos.store');
        Route::get('/documentos-profesional/{documento}/edit', [DocumentoProfesionalController::class, 'edit'])->name('documentos.edit');
        Route::put('/documentos-profesional/{documento}', [DocumentoProfesionalController::class, 'update'])->name('documentos.update');
        Route::delete('/documentos-profesional/{documento}', [DocumentoProfesionalController::class, 'destroy'])->name('documentos.destroy');
        Route::post('/documentos-profesional/{id}/aprobar', [DocumentoProfesionalController::class, 'aprobar'])->name('documentos.aprobar');
        Route::post('/documentos-profesional/{id}/denegar', [DocumentoProfesionalController::class, 'denegar'])->name('documentos.denegar');


        Route::get('/valoraciones', [ValoracionController::class, 'index'])->name('valoraciones.index');
        Route::get('/valoraciones/create', [ValoracionController::class, 'create'])->name('valoraciones.create');
        Route::post('/valoraciones', [ValoracionController::class, 'store'])->name('valoraciones.store');
        Route::get('/valoraciones/{valoracion}/edit', [ValoracionController::class, 'edit'])->name('valoraciones.edit');
        Route::get('/valoraciones/{valoracion}', [ValoracionController::class, 'show'])->name('valoraciones.show');
        Route::put('/valoraciones/{valoracion}', [ValoracionController::class, 'update'])->name('valoraciones.update');
        Route::delete('/valoraciones/{valoracion}', [ValoracionController::class, 'destroy'])->name('valoraciones.destroy');

        Route::get('/informes-consulta', [InformeConsultaController::class, 'index'])->name('informes.index');
        Route::get('/informes-consulta/{informe}', [InformeConsultaController::class, 'show'])->name('informes.show');
        Route::get('/informes-consulta/create', [InformeConsultaController::class, 'create'])->name('informes.create');
        Route::post('/informes-consulta', action: [InformeConsultaController::class, 'store'])->name('informes.store');
        Route::get('/informes-consulta/{informe}/edit', [InformeConsultaController::class, 'edit'])->name('informes.edit');
        Route::put('/informes-consulta/{informe}', [InformeConsultaController::class, 'update'])->name('informes.update');
        Route::delete('/informes-consulta/{informe}', [InformeConsultaController::class, 'destroy'])->name('informes.destroy');

        Route::get('/recetas', [RecetaController::class, 'index'])->name('recetas.index');
        Route::get('/recetas/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
        Route::get('/recetas/create', [RecetaController::class, 'create'])->name('recetas.create');
        Route::post('/recetas', [RecetaController::class, 'store'])->name('recetas.store');
        Route::get('/recetas/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
        Route::put('/recetas/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
        Route::delete('/recetas/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');

        Route::get('/preguntas-expertos', [PreguntaController::class, 'index'])->name('preguntas.index');
        Route::get('/preguntas-expertos/create', [PreguntaController::class, 'create'])->name('preguntas.create');
        Route::post('/preguntas-expertos', [PreguntaController::class, 'store'])->name('preguntas.store');
        Route::get('/preguntas-expertos/subespecialidades/{especialidad}', [PreguntaController::class, 'subespecialidadesPorEspecialidad'])->name('preguntas.subespecialidades.especialidad');
        Route::get('/preguntas-expertos/{pregunta}/edit', [PreguntaController::class, 'edit'])->name('preguntas.edit');
        Route::put('/preguntas-expertos/{pregunta}', [PreguntaController::class, 'update'])->name('preguntas.update');
        Route::delete('/preguntas-expertos/{pregunta}', [PreguntaController::class, 'destroy'])->name('preguntas.destroy');

        Route::get('/respuestas-expertos', [RespuestaController::class, 'index'])->name('respuestas.index');
        Route::get('/respuestas-expertos/create', [RespuestaController::class, 'create'])->name('respuestas.create');
        Route::post('/respuestas-expertos', [RespuestaController::class, 'store'])->name('respuestas.store');
        Route::get('/respuestas-expertos/{respuesta}/edit', [RespuestaController::class, 'edit'])->name('respuestas.edit');
        Route::put('/respuestas-expertos/{respuesta}', [RespuestaController::class, 'update'])->name('respuestas.update');
        Route::delete('/respuestas-expertos/{respuesta}', [RespuestaController::class, 'destroy'])->name('respuestas.destroy');
        Route::get('/respuestas-expertos/profesionales-by-pregunta', [RespuestaController::class, 'ProfesionalesPregunta'])->name('respuestas.profesionales-by-pregunta');

        // Métodos de Pago
        Route::get('/metodos-pagos', [MetodoPagoController::class, 'index'])->name('metodos-pagos.index');
        Route::get('/metodos-pagos/create', [MetodoPagoController::class, 'create'])->name('metodos-pagos.create');
        Route::post('/metodos-pagos', [MetodoPagoController::class, 'store'])->name('metodos-pagos.store');
        Route::get('/metodos-pagos/{metodo}/edit', [MetodoPagoController::class, 'edit'])->name('metodos-pagos.edit');
        Route::put('/metodos-pagos/{metodo}', [MetodoPagoController::class, 'update'])->name('metodos-pagos.update');
        Route::delete('/metodos-pagos/{metodo}', [MetodoPagoController::class, 'destroy'])->name('metodos-pagos.destroy');
        Route::get('/metodos-pagos/{metodo}', [MetodoPagoController::class, 'show'])->name('metodos-pagos.show');

        // RUTAS DEL BLOG
        Route::prefix('blog')->name('blog.')->group(function () {
            // Categorías del blog
            Route::get('/categorias', [CategoriaBlogController::class, 'index'])->name('categorias.index');
            Route::get('/categorias/create', [CategoriaBlogController::class, 'create'])->name('categorias.create');
            Route::post('/categorias', [CategoriaBlogController::class, 'store'])->name('categorias.store');
            Route::get('/categorias/{categoria}/edit', [CategoriaBlogController::class, 'edit'])->name('categorias.edit');
            Route::put('/categorias/{categoria}', [CategoriaBlogController::class, 'update'])->name('categorias.update');
            Route::delete('/categorias/{categoria}', [CategoriaBlogController::class, 'destroy'])->name('categorias.destroy');
            Route::get('/categorias/{categoria}', [CategoriaBlogController::class, 'show'])->name('categorias.show');

            // Etiquetas del blog
            Route::get('/etiquetas', [EtiquetaBlogController::class, 'index'])->name('etiquetas.index');
            Route::get('/etiquetas/create', [EtiquetaBlogController::class, 'create'])->name('etiquetas.create');
            Route::post('/etiquetas', [EtiquetaBlogController::class, 'store'])->name('etiquetas.store');
            Route::get('/etiquetas/{etiqueta}/edit', [EtiquetaBlogController::class, 'edit'])->name('etiquetas.edit');
            Route::put('/etiquetas/{etiqueta}', [EtiquetaBlogController::class, 'update'])->name('etiquetas.update');
            Route::delete('/etiquetas/{etiqueta}', [EtiquetaBlogController::class, 'destroy'])->name('etiquetas.destroy');
            Route::get('/etiquetas/{etiqueta}', [EtiquetaBlogController::class, 'show'])->name('etiquetas.show');

            // Artículos del blog
            Route::get('/articulos', [ArticuloBlogController::class, 'index'])->name('articulos.index');
            Route::get('/articulos/create', [ArticuloBlogController::class, 'create'])->name('articulos.create');
            Route::post('/articulos', [ArticuloBlogController::class, 'store'])->name('articulos.store');
            Route::get('/articulos/{articulo}/edit', [ArticuloBlogController::class, 'edit'])->name('articulos.edit');
            Route::put('/articulos/{articulo}', [ArticuloBlogController::class, 'update'])->name('articulos.update');
            Route::delete('/articulos/{articulo}', [ArticuloBlogController::class, 'destroy'])->name('articulos.destroy');
            Route::get('/articulos/{articulo}', [ArticuloBlogController::class, 'show'])->name('articulos.show');

            // Acciones adicionales para artículos
            Route::patch('/articulos/{articulo}/estado', [ArticuloBlogController::class, 'cambiarEstado'])->name('articulos.cambiarEstado');
            Route::post('/articulos/{articulo}/duplicar', [ArticuloBlogController::class, 'duplicar'])->name('articulos.duplicar');
        });

        // Rutas AJAX para blog
        Route::post('/blog/categorias/ajax-store', [CategoriaBlogController::class, 'ajaxStore'])->name('blog.categorias.ajax.store');
        Route::post('/blog/etiquetas/ajax-store', [EtiquetaBlogController::class, 'ajaxStore'])->name('blog.etiquetas.ajax.store');
    });
});
Route::get('/mail-test', [MailTestController::class, 'sendTest']);
