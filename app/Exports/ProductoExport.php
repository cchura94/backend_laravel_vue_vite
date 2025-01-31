<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductoExport implements /*FromCollection*/ FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Producto::all();
    // }

    public function view(): View
    {
        return view('excel.exports.productos', [
            'productos' => Producto::all()
        ]);
    }
}
