<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // /api/producto?page=2&limit=10&q=silla
        $limit = isset($request->limit)?$request->limit:10;
        if(isset($request->q)){
            $productos= Producto::where('nombre', 'like', "%$request->q%")
                                ->orWhere('precio', 'like', "%$request->q%")
                                ->orderBy('id', 'desc')
                                ->paginate($limit);
        }else{
            $productos= Producto::orderBy('id', 'desc')->paginate($limit);
        }

        return response()->json($productos, 200);
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
