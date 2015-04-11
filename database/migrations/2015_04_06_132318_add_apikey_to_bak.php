<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApikeyToBak extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::table('bak', function(Blueprint $table)
		{
			$table->string('apikey', 40);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('bak', function(Blueprint $table)
		{
            $table->dropColumn('apikey');
		});
	}

}
