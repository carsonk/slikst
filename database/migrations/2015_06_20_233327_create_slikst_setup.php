<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlikstSetup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('schools', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->softDeletes();
        });

        Schema::create('professors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('added_by_user_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('added_by_user_id')->references('id')->on('users');
        });

		Schema::create('cribs', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description');
            $table->string('filename', 100);
            $table->integer('up_votes')->default(1);
            $table->integer('down_votes')->default(0);
            $table->integer('user_id')->unsigned();
            $table->integer('school_id');
            $table->integer('professor_id')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('cribs');
        Schema::drop('professors');
        Schema::drop('schools');
	}

}
