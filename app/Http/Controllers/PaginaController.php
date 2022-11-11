<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\page\DB;

class PaginaController extends Controller
{
    public function inicio()
    {
        return view('landingpage');  
    }

    public function formulario($codigo = null)
    {
        if($codigo == 1234){
            $nombre = "Alejandro";
            $email = "correo@correo.com";
            $comentario = "Comentario predeterminado";
        }else{
            $codigo = null;
            $email = null;
            $nombre = null;
            $comentario = null;
        } 

        return view('contacto', compact('codigo', 'nombre', 'email', 'comentario'));
    }

    public function recibeForm(Request $request)
    {
        $request->validate([
            'nombre' => 'required | max:255 |min:4',
            'email' => 'required |email',
            'comentario' => 'required |max:1000 |min:5',
        ]);
        
        DB::table('contactos')->insert([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'comentario' => $request->comentario,
        ]);
        
        return redirect('/contacto');
    }
}
