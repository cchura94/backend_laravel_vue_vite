<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1/auth')->group(function(){

    Route::post('/login', [AuthController::class, "funLogin"]);
    Route::post('/register', [AuthController::class, "funRegister"]);

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/profile', [AuthController::class, "funProfile"]);
        Route::post('/logout', [AuthController::class, "funLogout"]);
    });
});

Route::post('reset-password', [ResetPasswordController::class, "resetPassword"]);
Route::post('change-password', [ResetPasswordController::class, "changePassword"]);

Route::get('email/verify/{id}', [AuthController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [AuthController::class, "resend"])->name("verification.resend")->middleware('auth:sanctum');

// pruebas seeder
Route::get("datos", function(){
    $user = User::find(8);
    return $user->permisos;
});

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get("producto/excel", [ProductoController::class, "exportarExcel"]);
    Route::get("pedido/{id}/reporte-pdf", [PedidoController::class, "reportePedidoPDF"]);
    
    Route::get("/cliente/buscar", [ClienteController::class, "funBuscar"]);

    Route::post("/usuario/asignar-persona", [UsuarioController::class, "asignarPersona"]);

    // subida de imagen
    Route::post("producto/{id}/upload-image", [ProductoController::class, "updateImage"]);

    // controlador de recursos (API)
    Route::apiResource("usuario", UsuarioController::class);
    Route::apiResource("persona", PersonaController::class);

    Route::apiResource("categoria", CategoriaController::class);
    Route::apiResource("producto", ProductoController::class);
    Route::apiResource("pedido", PedidoController::class);
    Route::apiResource("cliente", ClienteController::class);
    Route::apiResource("permiso", PermisoController::class);
    Route::apiResource("role", RoleController::class);

});

Route::get("/no-autorizado", function (){
    return response()->json(["message" => "No esta autorizado para ver esta pagina"], 401);
})->name("login");