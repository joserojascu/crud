<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        // //pagina de inicio 
        $datos = Productos::all();
        return view('productos', compact('datos'));

    }
}
