<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::with('user')->get();

        return response()->json($personas, 200);
    }

    public function guardarValorSiguiente(Request $request){
        $nombre = $request->nombre;
        $valorsiguiente = Contador::obtenerSiguienteValor($nombre);
        return $valorsiguiente;
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
}
