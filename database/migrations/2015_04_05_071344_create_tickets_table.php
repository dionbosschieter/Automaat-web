<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('ticket', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('ticket_number');
            $table->unsignedInteger('bak_id');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('given');
            $table->string('webcode');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::drop('ticket');
	}

}
