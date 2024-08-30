<?php

namespace App\Http\Controllers;

use App\Exports\ProductoExport;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


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
                                ->with('categoria')
                                ->paginate($limit);
        }else{
            $productos= Producto::orderBy('id', 'desc')->with('categoria')->paginate($limit);
        }

        return response()->json($productos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required|min:3|max:200",
            "categoria_id" => "required"
        ]);

        $producto = Producto::where("nombre", "=", $request->nombre)->first();
        if(isset($producto)){
            return response()->json(["message" => "El Producto ya ha sido registrado"], 422);
        }

        // guardar
        
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->descripcion = $request->descripcion;
        $producto->categoria_id = $request->categoria_id;
        $producto->save();

        return response()->json(["message" => "producto registrado"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);

        return response()->json($producto, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // buscamos
            $producto = Producto::findOrFail($id);
    
            // actualizar
            $producto->nombre = $request->nombre;
            $producto->precio = $request->precio;
            $producto->cantidad = $request->cantidad;
            $producto->descripcion = $request->descripcion;
            $producto->categoria_id = $request->categoria_id;
            $producto->update();

            DB::commit();
            return response()->json(["message" => "Producto actualizado"], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message" => "Ocurrió un error al actualizar el producto", "error" => $e->getMessage()], 422);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->estado = false;
        $producto->update();
        
        return response()->json(["message" => "Producto Inactivo"], 200);

    }

    function updateImage(Request $request, $id){
        $producto = Producto::findOrFail($id);

        if($file = $request->file("imagen")){
           $nombre_imagen = "";
           $direccion_image = time()."-".$file->getClientOriginalName();
           $file->move("imagenes/", $direccion_image);
           
           $direccion_image = "imagenes/". $direccion_image;

           $producto->imagen = $direccion_image;
           $producto->update();
           return response()->json(["message" => "Imagen actualizada"], 200);

        }
    }

    public function exportarExcel(){
        return Excel::download(new ProductoExport, 'producto.xlsx');
    } 
}
