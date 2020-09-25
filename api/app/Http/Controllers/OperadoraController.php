<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Operadora;
use App\Models\TipoOperadora;

use App\Http\Resources\OperadoraCollection;
use App\Http\Resources\OperadoraSingle;

class OperadoraController extends Controller
{
	/**
	* Busca a metainformação dos campos necessários para popular o payload
	*
	* @return \Illuminate\Http\Response
	*/
	public function getPayload()
	{
		return Schema::getColumnListing((new Operadora)->getTable());
	}

	/**
	* Busca todas as operadoras
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function getAll()
	{
		return Operadora::with('TipoOperadora')->orderBy('id', 'desc')->get();
	}

	/**
	* Busca uma operadora por id
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function get($id)
	{
		$result = Operadora::with('TipoOperadora')->find($id);
		return $result;
	}

	/**
	* Adiciona uma operadora
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function post(Request $request)
	{
		$sucessMessage = "Inserido com sucesso";

		try {
			$obj = new Operadora([
				'tipo_operadoras_id' => $request->get('tipo_operadoras_id'),
				'ativo' => 1,
				'desc' => $request->get('desc')
			]);

			if($obj->save()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Atualiza uma operadora
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function put($id, Request $request)
	{
		$sucessMessage = "Atualizado com sucesso";

		try {
			$obj = Operadora::find($id);
			$obj->desc = $request->desc;

			if($obj->save()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Desativa uma operadora
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function deactivate($id)
	{
		$sucessMessage = "Desativado com sucesso";

		if (!$id) {
			throw new HttpException(400, "Id inválido");
		}

		try {
			$obj = Operadora::find($id);

			$obj->ativo = 0;
			if($obj->save()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Desativa um array de ids
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function deactivateMany(Request $request)
	{
		$sucessMessage = "Lista de operadoras desativado com sucesso";

		try {

			foreach ($request->ids as $id){
				if (!$id) {
					throw new HttpException(400, "Id inválido");
				}

				$obj = Operadora::find($id);

				$obj->ativo = 0;
				$obj->save();
			}

			return $sucessMessage;

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Deleta permanentemente uma operadora
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function delete($id)
	{
		$sucessMessage = "Deletado permanentemente com sucesso";

		try {
			$obj = Operadora::find($id);

			if($obj->delete()){
				return $sucessMessage;
			}

		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}

	/**
	* Deleta permanentemente um array de ids
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function deleteMany(Request $request)
	{
		$sucessMessage = "Lista de operadoras deletado permanentemente com sucesso";

		try {
			foreach ($request->ids as $id){
				if (!$id) {
					throw new HttpException(400, "Id inválido");
				}

				$obj = Operadora::find($id);

				if($obj->delete()){
				}
			}

			return $sucessMessage;
		} catch (Exception $e) {
			throw new HttpException(400, "Dados inválidos - {$e->getMessage}");
		}
	}
}
