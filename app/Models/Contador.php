<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    use HasFactory;

    protected $fillable = ["nombre", "valor"];


    // public $timestamps = false;
    public static function obtenerSiguienteValor($nombre){
        $contador = self::orderBy('id', "desc")->first();

        // if(!$contador){
        //     $contador = self::create(["nombre" => $nombre, "valor" => 2000]);
        // }

        $nextValue = $contador->valor + 1;
        $contador = self::create(["nombre" => $nombre, "valor" => $nextValue]);
        return $nextValue;

    }
}
