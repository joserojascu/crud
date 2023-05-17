<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\Factulineas;
use App\Models\Formulas;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactulineasController extends Controller
{
    public function index()
    {
        // //pagina de inicio 
        $datos1 = Factulineas::all();
        return $datos1;
    }


    public function destroy($id, $id_formula,$id_cliente)
    {
        $personas = Factulineas::find($id);
        $personas->delete();
        $datos = Productos::all();

        $clientes = Clientes::find($id_cliente);

        // Realizamos la consulta utilizando INNER JOIN
        $datos1 = DB::table('factulineas')
            ->join('productos', 'factulineas.id_producto', '=', 'productos.id')
            ->select('factulineas.id_producto', 'factulineas.id', 'productos.nombre', 'productos.precio', 'productos.lote', 'productos.vencimiento', DB::raw('SUM(factulineas.cantidad) as total_cantidad'))
            ->where('factulineas.id_formula', $id_formula)
            ->groupBy('factulineas.id_producto','factulineas.id', 'productos.nombre', 'productos.precio', 'productos.lote', 'productos.vencimiento')
            ->get();

        return view("dashboard", compact('datos', 'id_formula', 'datos1', 'clientes'));
        // return redirect()->route("factulineas.index")->with("success", "Eliminado con exito!");
    }



    public function store(Request $request)
    {
        //sirve para guardar datos en la bd
        $factura = new Factulineas();
        $factura->id;
        $factura->id_formula = $request->post('id_formula');
        $factura->id_producto = $request->post('id_producto');
        $factura->cantidad = $request->post('cantidad');
        $factura->save();
        $id_formula = $request->post('id_formula');
        $id_cliente =  $request->post('id_cliente');
        $clientes = Clientes::find($id_cliente);
        $datos = Productos::all();

        // Realizamos la consulta utilizando INNER JOIN
        $datos1 = DB::table('factulineas')
            ->join('productos', 'factulineas.id_producto', '=', 'productos.id')
            ->select('factulineas.id','factulineas.id_producto', 'productos.nombre', 'productos.precio', 'productos.lote', 'productos.vencimiento', DB::raw('SUM(factulineas.cantidad) as total_cantidad'))
            ->where('factulineas.id_formula', $id_formula)
            ->groupBy('factulineas.id_producto','factulineas.id', 'productos.nombre', 'productos.precio', 'productos.lote', 'productos.vencimiento')
            ->get();
     
        return view("dashboard", compact('factura', 'datos', 'id_formula', 'datos1','clientes' ));
    }
    

    public function edit($id)
    {
        //este metodo nos sirve para traer los datos que se van a editar
        //y los coloca en un formulario
        
        $facturaV = Factulineas::find($id);
        $datos = Productos::all();
        return view("productos" , compact('facturaV', 'datos'));
        
    }

    public function update(Request $request, $id)
    {
        //este metodo actualiza los datos en la bd
        $factura = Factulineas::find($id);
        $factura->id_producto = $request->post('id_producto');
        $factura->cantidad = $request->post('cantidad');
        $factura->save();


        $id_formula = $factura->id_formula;
        $formulas = Formulas::find($id_formula);

        $id_cliente = $formulas->id_cliente;
        $clientes = Clientes::find($id_cliente);

        $datos = Productos::all();

        // Realizamos la consulta utilizando INNER JOIN
        $datos1 = DB::table('factulineas')
            ->join('productos', 'factulineas.id_producto', '=', 'productos.id')
            ->select('factulineas.id','factulineas.id_producto', 'productos.nombre', 'productos.precio', 'productos.lote', 'productos.vencimiento', DB::raw('SUM(factulineas.cantidad) as total_cantidad'))
            ->where('factulineas.id_formula', $id_formula)
            ->groupBy('factulineas.id_producto','factulineas.id', 'productos.nombre', 'productos.precio', 'productos.lote', 'productos.vencimiento')
            ->get();
        return view("dashboard", compact('factura', 'datos', 'id_formula', 'datos1','clientes' ));
       
    }
}
