<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CaseSensitiveUrl extends Migration {

	/**
	 * Run the migrations.
     *
     * Because Laravels Schema builder doesn't support adding BINARY types to columns to remove case insensitivity in MySQL we have to just run a raw statement here.
	 *
	 * @return void
	 */
	public function up()
    {
        // this is horribly hacky, but the following query breaks sqlite tests and only needs to affect mysql atm... ugh.
        if(DB::getDriverName() == 'mysql')
        {
            DB::statement('ALTER TABLE securesends CHANGE url url VARCHAR(255) BINARY');
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // this is horribly hacky, but the following query breaks sqlite tests and only needs to affect mysql atm... ugh.
        if(DB::getDriverName() == 'mysql')
        {
            DB::statement('ALTER TABLE securesends CHANGE url url VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci');
        }
	}

}
