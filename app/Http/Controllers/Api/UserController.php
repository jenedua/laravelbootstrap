<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Retorna uma lista paginada de usuarios
     * Este método recupera uma lista paginada de usuarios do banco de dados
     * e a retorna como uma resposta JSON
     *
     * @return Illuminate\Http\JsonResponse;
     */
    public function index() : JsonResponse
    {
        // Recuperar os usuários do banco de dados, ordenado pelo id em ordem decrescente , paginados
        $users = User::orderBy('id', 'DESC') ->paginate(3);

        //Retorna os usuários recuperados como uma resposta JSON
        return response()->json([
                    'status' => true,
                    'users' => $users,
                ], 200);

    }
    /**
     * Exibe os detalhes de um usuários específico.
     * 
     * Este método retorna os detalhes de um usuário específico em formato JSON. 
     *
     * @param App\Models\User $user  O objeto do usuário a ser exibido
     * @return Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        // return os detalhes do usuário em formato JSON
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);

    }
    /**
     * Criar um novo usuário com os dados fornecidos na requisição
     * @param \App\Http\Request\UserRequest $request O objeto de requisição contendo os dados do usuario a ser criado.
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(UserRequest $request): JsonResponse
    {
        //iniciar a transação
        DB::beginTransaction();

        try {
           $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Operação é concluida com êxito
            DB::commit();

            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => "Usuario cadastrado com successo...",

            ], 201);
            
        } catch (Exception $e) {
            // Operação não é concluída com êxito
            DB::rollBack();

            //Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "Usuario não cadastrado!",

            ], 400);
            
        }

    }

    /**
     * Atualizar os dados de um usuário existente com base nos dados fornecidos na requisição.
     * @param \App\Http\Requests\UserRequest $request O objeto de requisição contendo os dados do usuario a ser atualizado.
     * @param \App\Models\User $user O usuario a ser atualizado.
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(UserRequest $request, User $user): JsonResponse
    {

        try {
            // Editado o registro no banco de dados

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);
             // Operação é concluida com êxito
             DB::commit();
            // Retornado os dados do usuario editado e uma mensagem de sucesso com status 200
             return response()->json([
                 'status' => true,
                 'user' => $user,
                 'message' => "Usuario editado com successo...",
 
             ], 200);
             
            
        } catch (Exception $e) {
            // Operação não é concluída com êxito
            DB::rollBack();

            //Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "Usuario não editado!",

            ], 400);

            
        }
    } 

    public function destroy(User $user) :JsonResponse
    {
        try {
            $user->delete();

            // Retornado os dados do usuario apagado e uma mensagem de sucesso com status 200
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => "Usuario apagado com successo...",

            ], 200);

        } catch (Exception $e) {

             //Retorna uma mensagem de erro com status 400
            return response()->json([
                'status' => false,
                'message' => "Usuario não apagado!",

            ], 400);
        }
        
    }








}
