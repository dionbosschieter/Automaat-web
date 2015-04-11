<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
            $table->foreign('bak_id')->references('id')->on('bak');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->dropForeign('tickets_bak_id_foreign');
		});
	}

}
