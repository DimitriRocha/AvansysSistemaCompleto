<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OperadoraSingle extends JsonResource
{
	/**
	* Transform the resource into an array.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return array
	*/
	public function toArray($request)
	{
		return [
			'id'        			=> $this->id,
			'tipo_operadoras_id'	=> (int) $this->tipo_operadoras_id,
			'ativo'					=> (int) $this->answers,
			'desc'     				=> $this->desc,
			'created_at' 			=> $this->created_at,
			'updated_at' 			=> $this->updated_at,
		];
	}
}
