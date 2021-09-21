<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$data = Usuarios::all()){
            return  $this->successResponse([], 'Nenhum registro encontrado!', 200);
        }
        
        return  $this->successResponse($data, 'Operação realizada com sucesso!', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required|min:5|max:40',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required'
        ]);

        $usuario = new Usuarios();
        
        $usuario->usuario    = $request->usuario;
        $usuario->email      = $request->email;
        $usuario->password   = Hash::make($request->password);
        $usuario->verificado = isset($request->verificado) ? $request->verificado : '0';

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
        $data = Usuarios::find($id);

        if($data){
            $this->successResponse($data, 'Operação realizada com sucesso!', 200);
        }else{
            $this->successResponse([], 'Nenhum registro encontrado!', 200);
        }
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
        $this->validate($request, [
            'usuario'  => 'required|min:5|max:40',
            'email'    => 'required|email|'. Rule::unique('usuarios')->ignore($id),
            'password' => 'required'
        ]);
        
        $usuario = Usuarios::find($id);

        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->password   = Hash::make($request->password);
        $usuario->verificado = isset($request->verificado) ? $request->verificado : '0';

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
        $usuario = Usuarios::find($id);

        if($usuario->delete()){
            return response()->json('Deletado com sucesso!', 200);
        }else{
            return response()->json('Não foi possivel deletar!', 500);
        }
    }
}
