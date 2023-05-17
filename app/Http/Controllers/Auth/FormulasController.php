<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\Factulineas;
use App\Models\Formulas;
use App\Models\Productos;
use Illuminate\Http\Request;

class FormulasController extends Controller
{

    
    public function store(Request $request)
    {
        $formula = new Formulas();
        $formula->id_cliente = $request->post('id_cliente');
        $formula->tipo_facturacion = $request->post('tipo_facturacion');
        $formula->observacion = $request->post('observacion');
        $formula->id_usuario = $request->post('id_usuario');
        $formula->fecha_venta = $request->post('fecha');
        $formula->save();
    
        // Obtener todos los datos de la tabla Productos
        $datos = Productos::all();
        $id_formula = $formula->id_formula; 
        $cliente = $formula->id_cliente;
        $datos1 = Factulineas::where('id_formula', $id_formula)->get();
        $clientes = Clientes::find($cliente);
        return view("dashboard", compact('formula', 'datos', 'datos1' , 'clientes')); 
    }

}
