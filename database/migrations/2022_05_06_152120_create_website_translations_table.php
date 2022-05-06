<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('website_translations')) {
            Schema::create('website_translations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('website_id')->unsigned();

                $table->string('title')->nullable();
                $table->mediumText('description')->nullable();
                $table->mediumText('keywords')->nullable();
                $table->string('locale');
                //$table->tinyInteger('enabled')->unsigned()->default(1);

                $table->unique(['website_id', 'locale']);
                $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('website_translations');
	}

}
