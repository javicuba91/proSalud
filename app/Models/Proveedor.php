<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = [
        'user_id',
        'tipo',
        'nombre',
        'ciudad',
        'direccion',
        'numero_identificacion',
        'email',
        'telefono',
        'propietario_id',
        'seguros_id',
        'especializacion',
        'licencia',
        'direccion_maps',
        'imagenes',
        'imagen_corporativa',
        'informacion_adicional',
        'listado_servicios',
        'horarios',
        'clinica_edificio',
        'plan_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }
    public function seguros()
    {
        return $this->belongsTo(SegurosMedicos::class, 'seguros_id');
    }

    public function segurosMedicos()
    {
        return $this->belongsToMany(SegurosMedicos::class, 'seguros_proveedores', 'proveedor_id', 'seguros_id');
    }
    public function documentos()
    {
        return $this->hasMany(DocumentosProveedor::class, 'proveedor_id');
    }
    public function suscripciones()
    {
        return $this->hasOne(SuscripcionesPlanesProveedores::class, 'proveedores_id');
    }

    public function documentosAprobados()
    {
        // Si no tiene documentos, retorna false
        if ($this->documentos()->count() === 0) {
            return false;
        }
        // Si todos los documentos están aprobados
        return $this->documentos()->where('estado', '!=', 'aprobado')->count() === 0;
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public static function presupuestos_laboratorios_aprobados_por_paciente($id_paciente)
    {
        $proveedor = Proveedor::where('user_id', Auth::id())->first();

       $presupuestos_pacientes = DB::select("
           SELECT pp.id, pp.precio,pp.estado as estadoPresupuesto, pr.id as idPrueba, pr.tipo,pl.motivo,pr.prioridad,pr.estado as estadoPrueba,pr.created_at as fechaSolicitudPrueba, pac.nombre_completo
           FROM presupuestos_pruebas pp
           INNER JOIN proveedores p ON p.id = pp.proveedor_id
           INNER JOIN pruebas pr ON pr.id = pp.prueba_id
           INNER JOIN pedido_laboratorios pl ON pl.id = pr.pedido_laboratorio_id
           INNER JOIN informes_consultas ic ON ic.id = pl.informe_consulta_id
           INNER JOIN citas c ON c.id = ic.cita_id
           INNER JOIN pacientes pac ON pac.id = c.paciente_id
           WHERE p.tipo='laboratorio' AND p.id = ? AND pac.id = ?
       ", [$proveedor->id, $id_paciente]);

       return $presupuestos_pacientes;
    }

    public static function presupuestos_imagenes_aprobados_por_paciente($id_paciente)
    {
        $proveedor = Proveedor::where('user_id', Auth::id())->first();

       $presupuestos_pacientes = DB::select("
           SELECT pp.id, pp.precio,pp.estado as estadoPresupuesto, pr.id as idPrueba, pr.tipo,pr.region_anatomica,pr.prioridad,pr.estado as estadoPrueba,pr.created_at as fechaSolicitudPrueba, pac.nombre_completo
           FROM presupuestos_pruebas pp
           INNER JOIN proveedores p ON p.id = pp.proveedor_id
           INNER JOIN pruebas pr ON pr.id = pp.prueba_id
           INNER JOIN pedido_imagenes pl ON pl.id = pr.pedido_imagen_id
           INNER JOIN informes_consultas ic ON ic.id = pl.informe_consulta_id
           INNER JOIN citas c ON c.id = ic.cita_id
           INNER JOIN pacientes pac ON pac.id = c.paciente_id
           WHERE p.tipo='centro_imagenes' AND p.id = ? AND pac.id = ?
       ", [$proveedor->id, $id_paciente]);

       return $presupuestos_pacientes;
    }
    public function valoraciones()
    {
        return $this->hasMany(ValoracionProveedor::class);
    }
    public function contactos()
    {
        return $this->hasMany(ContactoAdminProveedores::class);
    }

}
