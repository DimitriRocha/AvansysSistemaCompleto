<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Operadora;
use App\Models\TipoOperadora;

use App\Http\Resources\OperadoraCollection;
use App\Http\Resources\OperadoraSingle;

class TipoOperadoraController extends Controller
{
	/**
	* Busca a metainformação dos campos necessários para popular o payload
	*
	* @return \Illuminate\Http\Response
	*/
	public function getPayload()
	{
		return Schema::getColumnListing((new TipoOperadora)->getTable());
	}

	/**
	* Busca todas os tipos de operadora
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function getAll()
	{
		return TipoOperadora::all();
	}

	/**
	* Busca um tipo de operadora por id
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function get($id)
	{
		$result = TipoOperadora::find($id);
		return $result;
	}

	/**
	* Adiciona uma tipo de operadora
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function post(Request $request)
	{
		$sucessMessage = "Inserido com sucesso";

		try {
			$obj = new TipoOperadora([
				'nome' => $request->get('nome'),
			]);

			if($obj->save()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Atualiza uma tipo de operadora
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function put($id, Request $request)
	{
		$sucessMessage = "Atualizado com sucesso";

		try {
			$obj = TipoOperadora::find($id);
			$obj->nome = $request->nome;

			if($obj->save()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Deleta permanentemente uma tipo de operadora
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function delete($id)
	{
		$sucessMessage = "Deletado permanentemente com sucesso";

		try {
			$obj = TipoOperadora::find($id);

			if($obj->delete()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}
}
