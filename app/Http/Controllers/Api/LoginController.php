<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        //validar o e-mail e a senha
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            // Recuperar os dados do usuário 
            $user = Auth::user();

            $token=$request->user()->createToken('api-token')->plainTextToken;

            return Response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user
            ], 201);

        }else{
            return Response()->json([
                'status' => false,
                'message' => "Email ou senha invalido!"
            ], 404);
        }
    }

    public function logout(User $user):JsonResponse
    {
        try {

            $user->tokens()->delete();
            return Response()->json([
                'status' => true,
                'message' => "Deslogado com sucesso..."
            ], 200);
            
        } catch (Exception $e) {
            return Response()->json([
                'status' => false,
                'message' => "Não deslogado."
            ], 404);
            
        }

    }


}
