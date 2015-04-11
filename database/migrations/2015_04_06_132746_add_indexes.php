<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexes extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::table('bak', function(Blueprint $table)
		{
			$table->unique('apikey');
		});

        Schema::table('ticket', function(Blueprint $table)
        {
            $table->index('ticket_number');
        });
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('bak', function(Blueprint $table)
		{
			$table->dropUnique('bak_apikey_unique');
		});

        Schema::table('ticket', function(Blueprint $table)
        {
            $table->dropIndex('ticket_ticket_number_index');
        });
	}

}
