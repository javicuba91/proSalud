<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\SegurosMedicos;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use Spatie\PdfToText\Pdf;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        $seguros = SegurosMedicos::all();
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function cargarMedicamentos()
    {
        /*$parser = new Parser();
        $pdf = $parser->parseFile('medicamentos/medicamentos.pdf');

        $text = $pdf->getText();

        $lineas = explode("\n", $text);
        $principios = [];

        foreach ($lineas as $linea) {
            // Intentamos separar por tabulaciones o múltiples espacios
            $partes = preg_split('/\s{3,}/', trim($linea));

            // Si tiene al menos 3 columnas, tomamos la tercera (índice 2)
            if (isset($partes[2])) {
                $principios[] = $partes[2];
            }
        }

        $principios = array_unique($principios);
        sort($principios);

        // Eliminar duplicados
        $principios = array_unique($principios);

        // Guardar en la base de datos
        foreach ($principios as $nombre) {
            Medicamento::updateOrCreate(['nombre' => $nombre]);
        }

        return response()->json(['mensaje' => 'Medicamentos importados con éxito', 'cantidad' => count($principios)]);
    */

        $rutaArchivo = public_path('medicamentos/medicamentos.txt');

        // Verificar si el archivo existe
        if (!file_exists($rutaArchivo)) {
            $this->error('El archivo medicamentos.txt no existe en la ruta especificada.');
            return;
        }

        // Leer el contenido del archivo
        $contenido = file_get_contents($rutaArchivo);
        $lineas = explode("\n", $contenido);

        foreach ($lineas as $linea) {
            // Eliminamos espacios extra
            $linea = preg_replace('/\s+/', ' ', trim($linea));
            $partes = explode(' ', $linea, 3);

            if (count($partes) >= 3) {
                $nombreBruto = $partes[2];

                $nombre = preg_split('/\s+(TAB|INY|VIAL|UNG|CAP|ML|MG|G|UNIDAD|%|\d+ ?mg|\d+ ?ml)/i', $nombreBruto)[0];
                $nombre = trim($nombre);

                if (!empty($nombre)) {
                    Medicamento::firstOrCreate(['nombre' => $nombre]);
                }
            }
        }

        return response()->json([
            'contenido' => "Carga completada"
        ]);
    }
}
