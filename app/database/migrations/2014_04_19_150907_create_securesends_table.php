<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateSecuresendsTable
 */
class CreateSecuresendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('securesends', function(Blueprint $table) {
            
            $table->engine = 'InnoDB';

			$table->increments('id')->unique()->unsigned();
            $table->string('url')->unique();
            $table->string('pass');
            $table->date('expiration_date');
            $table->tinyInteger('expiration_views')->unsigned();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('securesends');
	}

}
