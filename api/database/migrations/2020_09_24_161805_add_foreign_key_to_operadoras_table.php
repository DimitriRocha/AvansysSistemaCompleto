<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToOperadorasTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::table('operadoras', function (Blueprint $table) {
			$table->foreign('tipo_operadoras_id')->references('id')->on('tipo_operadoras');
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::table('operadoras', function (Blueprint $table) {
			$table->dropForeign(['tipo_operadoras_id']);
		});
	}
}
