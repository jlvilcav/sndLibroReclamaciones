<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLibReclamosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('libReclamos', function(Blueprint $table)
		{
			$table->bigIncrements('IDX_LIB_REC');
			$table->string('NUM_RECLAM',16);
			$table->bigInteger('IDX_NUM_DOCU_JUR')->nullable()->unsigned();
			$table->bigInteger('IDX_NUM_DOCU_NAT')->nullable()->unsigned();
			$table->char('FLAG_PERSONA',1);
			$table->text('DES_IDE_ATEN');
			$table->text('DES_ACC_ADOP');
			$table->bigInteger("IDX_USUA_CREA")->unsigned();
			$table->dateTime("FEC_USUA_CREA");
			$table->string("DES_TERM_CREA",50);
			$table->bigInteger("IDX_USUA_MODI")->unsigned();
			$table->dateTime("FEC_USUA_MODI");
			$table->string("DES_TERM_MODI",50);
			$table->char("BIT_ACTIVO",1);
			$table->foreign('IDX_USUA_CREA')->references('IDX_PERSONA')->on('usuario');
			$table->foreign('IDX_USUA_MODI')->references('IDX_PERSONA')->on('usuario');
			$table->foreign('IDX_NUM_DOCU_JUR')->references('IDX_JUR')->on('perJuridica');
			$table->foreign('IDX_NUM_DOCU_NAT')->references('IDX_NAT')->on('perNatural');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('libReclamos');
	}

}
