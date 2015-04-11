<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBakTable extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('bak', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->unsignedInteger('amount');
            $table->integer('status');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::drop('bak');
	}

}
