<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $fi = $request->fecha_inicio;
        // $ff = $request->fecha_fin;

        $pedidos = Pedido::with('productos', 'cliente')->get();

        return response()->json($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "cliente_id" => "required"
        ]);

        DB::beginTransaction();

        try {

            $productos = $request["productos"];

            $pedido = new Pedido();
            $pedido->fecha_pedido = date("Y-m-d H:i:s");
            $pedido->estado = $request->estado;
            $pedido->cliente_id = $request->cliente_id;
            $pedido->observaciones = $request->observaciones;
            $pedido->save();

            // guardar
            foreach ($productos as $prod) {
                $id_prod = $prod['id'];
                $cant_prod = $prod['cantidad'];

                $pedido->productos()->attach($id_prod, ["cantidad" => $cant_prod]);
            }

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
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
