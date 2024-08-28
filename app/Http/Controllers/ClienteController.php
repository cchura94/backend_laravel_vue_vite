<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function funBuscar(Request $request){
        $buscar = $request->q;

        $cliente = Cliente::where("nombre_completo", "like", "%$buscar%")->first();

        return response()->json($cliente, 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre_completo" => "required"
        ]);

        $cliente = new Cliente();
        $cliente->nombre_completo = $request->nombre_completo;
        $cliente->telefono = $request->telefono;
        $cliente->ci_nit = $request->ci_nit;
        $cliente->correo = $request->correo;
        $cliente->save();

        return response()->json($cliente, 201);
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
