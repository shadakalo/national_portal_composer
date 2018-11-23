<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSitesTable.
 */
class CreateSitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sitename_bn');
            $table->string('sitename_en');
            $table->string('site_email');
            $table->string('site_slogan_bn');
            $table->string('site_slogan_en');
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
		Schema::drop('sites');
	}
}
