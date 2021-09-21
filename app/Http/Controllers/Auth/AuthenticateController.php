<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    use ApiResponser;

    // protected $jwt;

    // public function __construct(JWTAuth $jwt)
    // {
    //     $this->jwt = $jwt;
    // }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        $token = null;
        
        if(!$token = JWTAuth::claims(['email' => $request->email])->attempt($request->only('email', 'password'))){
            return $this->errorResponse([], 'E-mail ou Senha inválidos', 404);
        }

        return $this->successResponse(compact('token'), 'Operação realizada com sucesso!', 200);
    }

    // public function me(){

    //     if(!$usuario = Auth::user()){
    //       return $this->errorResponse([], 'Nenhum registro encontrado!', 404);
    //     }else{
    //         return $this->successResponse($usuario, 'Operação realizada com sucesso!', 200);
    //     }
    // }

}
