<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUbigeosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ubigeos', function(Blueprint $table)
		{
			$table->bigIncrements('IDX_UBIGEO');
			$table->string("COD_DEPA_CONTINENTE",2);
			$table->string("COD_PROV_PAIS",2);
			$table->string("COD_DIST_CIUDAD",2);
			$table->string("DES_DEPA_CONTINENTE",60);
			$table->string("DES_PROV_PAIS",60);
			$table->string("DES_DIST_CIUDAD",60);
			$table->bigInteger("IDX_USUA_CREA")->unsigned();
			$table->dateTime("FEC_USUA_CREA");
			$table->string("DES_TERM_CREA",50);
			$table->bigInteger("IDX_USUA_MODI")->unsigned();
			$table->dateTime("FEC_USUA_MODI");
			$table->string("DES_TERM_MODI",50);
			$table->char("BIT_ACTIVO",1);
			$table->foreign('IDX_USUA_CREA')->references('IDX_PERSONA')->on('usuario');
			$table->foreign('IDX_USUA_MODI')->references('IDX_PERSONA')->on('usuario');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ubigeos');
	}

}
