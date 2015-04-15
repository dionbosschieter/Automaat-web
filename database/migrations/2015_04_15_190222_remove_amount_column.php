<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAmountColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bak', function(Blueprint $table)
		{
			$table->dropColumn('amount');
		});
	}

	/**
	 * Reverse the migrations.
     *
     * but we cannot get the data back
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bak', function(Blueprint $table)
		{
			$table->unsignedInteger('amount');
		});
	}

}
