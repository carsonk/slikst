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
			$table->integer('school_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('added_by_user_id')->references('id')->on('users');
			$table->foreign('school_id')->references('id')->on('schools');
        });

		Schema::create('courses', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('professor_id')->unsigned();
			$table->softDeletes();
			$table->timestamps();

			$table->foreign('professor_id')->references('id')->on('professors');
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
			$table->integer('course_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('course_id')->references('id')->on('courses');
		});

		Schema::table('users', function(Blueprint $table)
		{
			$table->integer('school_id')->unsigned();
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
		Schema::drop('courses');
        Schema::drop('professors');
        Schema::drop('schools');
	}

}
