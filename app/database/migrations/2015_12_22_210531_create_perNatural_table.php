<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerNaturalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perNatural', function(Blueprint $table)
		{
			$table->bigIncrements('IDX_NAT');
			$table->string('IDX_NUM_DOCU',20);
			$table->string('NOMBRE',120);
			$table->string('APE_PAT',60);
			$table->string('APE_MAT',60);
			$table->bigInteger('IDX_UBIGEO')->unsigned();
			$table->bigInteger('IDX_TIPDOC')->unsigned();
			$table->string('DOMICILIO',200);
			$table->string('EMAIL',120);
			$table->string('TEL_FIJO',120);
			$table->string('NUM_CELU',120);
			$table->bigInteger("IDX_USUA_CREA")->unsigned();
			$table->dateTime("FEC_USUA_CREA");
			$table->string("DES_TERM_CREA",50);
			$table->bigInteger("IDX_USUA_MODI")->unsigned();
			$table->dateTime("FEC_USUA_MODI");
			$table->string("DES_TERM_MODI",50);
			$table->char("BIT_ACTIVO",1);
			$table->foreign('IDX_USUA_CREA')->references('IDX_PERSONA')->on('usuario');
			$table->foreign('IDX_USUA_MODI')->references('IDX_PERSONA')->on('usuario');
			$table->foreign('IDX_TIPDOC')->references('IDX_TIPDOC')->on('tipDocumento');
			$table->foreign('IDX_UBIGEO')->references('IDX_UBIGEO')->on('ubigeos');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perNatural');
	}

}
