<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->bigIncrements('IDX_PERSONA');
			$table->string('DES_USUARIO',30);
			$table->string('DES_CLAVE',50);
			$table->char('BIT_ACTIVO',1);
			$table->bigInteger('IDX_USUA_CREA');
			$table->dateTime('FEC_USUA_CREA');
			$table->string('DES_TERM_CREA',50);
			$table->bigInteger('IDX_USUA_MODI');
			$table->dateTime('FEC_USUA_MODI');
			$table->string('DES_TERM_MODI',50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
