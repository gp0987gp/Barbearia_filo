<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminFormRequest;
use App\Http\Requests\AdminFormRequestUpdate;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function criarAdmin(AdminFormRequest $request)
    {
       $admin = Administrador::create([
            'nome' =>  $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'senha' => Hash::make($request->senha)

        ]);
        return response()->json([
            "success" => true,
            "message" => "Admin cadastrado com sucesso",
            "data" =>$admin
        ], 200);
    }

    public function pesquisarPorId($id)
    {
       $admin = Administrador::find($id);
        if ($admin == null) {
            return response()->json([
                'status' => false,
                'message' => "cliente não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' =>$admin
        ]);
    }


    public function retornarTodos()
    {
       $admin = Administrador::all();
        return response()->json([
            'status' => true,
            'data' =>$admin
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
       $admin =  Administrador::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($admin) > 0) {

            return response()->json([
                'status' => true,
                'data' =>$admin
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Não há resultados para a pesquisa.'
            ]);
        }
    }

    public function excluirCliente($id)
    {
       $admin = Administrador::find($id);

        if (!isset($admin)) {
            return response()->json([
                'status' => false,
                'message' => "cliente não encontrado"
            ]);
        }
       $admin->delete();
        return response()->json([
            'status' => true,
            'message' => "cliente excluido com sucesso"
        ]);
    }

    public function atualizarCliente(AdminFormRequestUpdate $request)
    {
       $admin = Administrador::find($request->id);

        if (!isset($admin)) {
            return response()->json([
                'status' => false,
                'message' => "Admin não atualizado"
            ]);
        }
        if (isset($request->celular)) {
           $admin->celular = $request->celular;
        }

        if (isset($request->nome)) {
           $admin->nome = $request->nome;
        }

        if (isset($request->email)) {
           $admin->email = $request->email;
        }

        if (isset($request->cpf)) {
           $admin->cpf = $request->cpf;
        }

        if (isset($request->dataNascimento)) {
           $admin->dataNascimento = $request->dataNascimento;
        }

        if (isset($request->cidade)) {
           $admin->cidade = $request->cidade;
        }

        if (isset($request->estado)) {
           $admin->estado = $request->estado;
        }

        if (isset($request->pais)) {
           $admin->pais = $request->pais;
        }

        if (isset($request->rua)) {
           $admin->rua = $request->rua;
        }

        if (isset($request->numero)) {
           $admin->numero = $request->numero;
        }

        if (isset($request->bairro)) {
           $admin->bairro = $request->bairro;
        }

        if (isset($request->cep)) {
           $admin->cep = $request->cep;
        }

        if (isset($request->complemento)) {
           $admin->complemento = $request->complemento;
        }

        if (isset($request->senha)) {
           $admin->senha = $request->senha;
        }


       $admin->update();

        return response()->json([
            'status' => true,
            'message' => "Cliente atualizados"
        ]);
    }

    public function pesquisarPorCpf(Request $request)
    {
       $admin = Administrador::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($admin) > 0) {

            return response()->json([
                'status' => true,
                'data' =>$admin
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorTelefone(Request $request)
    {
       $admin = Administrador::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($admin) > 0) {

            return response()->json([
                'status' => true,
                'data' =>$admin
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function pesquisarPorEmail(Request $request)
    {
       $admin = Administrador::where('email', 'like', '%' . $request->email . '%')->get();

        if (count($admin) > 0) {

            return response()->json([
                'status' => true,
                'data' =>$admin
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }

    public function esqueciMinhaSenha(Request $request)
    {
       $admin = Administrador::where('email', 'LIKE', $request->email)->first();
        if ($admin) {
            $novaSenha =$admin->cpf;
           $admin->update([
                'senha' => //Hash::make
                ($novaSenha),
                'updated_at' => now()
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Senha redefinida',
                'nova_senha' => Hash::make($novaSenha)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Cliente não encontrado'
            ]);
        }
    }
}
