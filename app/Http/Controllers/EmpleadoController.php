<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return Empleado::all();
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
        // 1. Validación de datos
        $validatedData = $request->validate([
            'primer_apellido' => ['required', 'string', 'max:20', 'regex:/^[A-Z]+$/'],
            'segundo_apellido' => ['required', 'string', 'max:50', 'regex:/^[A-Z]+$/'],
            'primer_nombre' => ['required', 'string', 'max:20', 'regex:/^[A-Z]+$/'],
            'otros_nombres' => ['nullable', 'string', 'max:50', 'regex:/^[A-Z]+$/'],
            'pais_empleo' => 'required|in:Colombia,Estados Unidos',
            'tipo_identificacion' => ['required', 'string', 'max:50'],
            'numero_identificacion' => ['required', 'string', 'max:20', 'unique:empleados,numero_identificacion'],
            'fecha_ingreso' => [
                'required',
                'date',
                'before_or_equal:' . now()->toDateString(),
                'after_or_equal:' . now()->subMonth()->toDateString()
            ],
            'area' => ['required', 'string', 'max:50'],
        ]);

        // 2. Normalización para generación de correo
        $primerNombreNormalized = strtolower(str_replace(' ', '', $validatedData['primer_nombre']));
        $primerApellidoNormalized = strtolower(str_replace(' ', '', $validatedData['primer_apellido']));
        $correoBase = $primerNombreNormalized . '.' . $primerApellidoNormalized;

        $dominio = $validatedData['pais_empleo'] === 'Colombia'
            ? 'cidenet.com.co'
            : 'cidenet.com.us';

        $correo = $correoBase . '@' . $dominio;
        $contador = 1;

        while (Empleado::where('correo', $correo)->exists()) {
            $correo = $correoBase . '.' . $contador++ . '@' . $dominio;
        }

        // 3. Crear el empleado
        try {
            $empleado = Empleado::create(array_merge(
                $validatedData,
                [
                    'correo' => $correo,
                    'estado' => 'Activo',
                    'fecha_registro' => now(),
                ]
            ));

            return response()->json($empleado, 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo registrar el empleado.',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
