<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrunkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trunk', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('bak_id');
            $table->unsignedInteger('number');
            $table->unsignedInteger('bill_type');
            $table->unsignedInteger('available');
            $table->text('description');
		});

        Schema::table('trunk', function(Blueprint $table)
        {
            $table->foreign('bak_id')->references('id')->on('bak');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('bak');
	}

}
