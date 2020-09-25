<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperadorasTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::disableForeignKeyConstraints();
		Schema::create('operadoras', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('tipo_operadoras_id');
			$table->boolean('ativo');
			$table->string('desc', 100);
			$table->timestamps();
		});
		Schema::enableForeignKeyConstraints();
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('operadoras');
	}
}
