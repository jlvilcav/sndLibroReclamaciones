<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipDocumento', function(Blueprint $table)
		{
			$table->bigIncrements('IDX_TIPDOC');
			$table->string("DES_TIPDOC",50);
			$table->string("ABR_TIPDOC",20);
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
		Schema::drop('tipDocumento');
	}

}
