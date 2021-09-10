<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(!empty($usuarios = Usuario::all()) ? $usuarios : 'Nenhum registro encontrado!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        
        $usuario->usuario    = $request->usuario;
        $usuario->email      = $request->email;
        $usuario->password   = Hash::make($request->senha);
        // $usuario->verificado = $request->verificado;

        if($usuario->save()){
            return response()->json($usuario, 202);
        }else{
            return response()->json('Não foi possivel cadastrar usuário', 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(!empty($usuario = Usuario::find($id)) ? $usuario : 'Nenhum registro encontrado!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password = $request->senha;

        if($usuario->update()){
            return response()->json($usuario, 200);
        }else{
            return response()->json('Não foi possivel atualizar dados do usuário', 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if($usuario->delete()){
            return response()->json('Deletado com sucesso!', 200);
        }else{
            return response()->json('Não foi possivel deletar!', 500);
        }
    }
}
