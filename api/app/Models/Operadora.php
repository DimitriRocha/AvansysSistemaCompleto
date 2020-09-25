<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operadora extends Model
{
    use HasFactory;
	protected $guarded = [];
	public function TipoOperadora()
    {
        return $this->belongsTo('App\Models\TipoOperadora', 'tipo_operadoras_id');
    }
}
