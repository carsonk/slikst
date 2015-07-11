<?php

use App\School;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$kettering = new School;
		$kettering->name = "Kettering University";
		$kettering->save();
	}

}
