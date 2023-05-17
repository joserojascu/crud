<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    //

    public function index()
    {
        //pagina de inicio 
        if (auth()->check()) {
            // El usuario está autenticado
            $datos_cliente = Clientes::all();
            return view('dashboard', compact('datos_cliente'));
        } else {
            // El usuario no está autenticado
            return redirect('login');
        }
       
    }
 
    public function show($id)
    {
        $clientes = Clientes::find($id);
        return view("dashboard" , compact('clientes'));
    }
    
    public function buscar(Request $request) {
        $id = $request->input('id');
        $clientes = Clientes::find($id);
        return view("dashboard" , compact('clientes'));
      }
}
