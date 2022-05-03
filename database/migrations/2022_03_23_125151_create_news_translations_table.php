<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNewsTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('news_translations')) {
            Schema::create('news_translations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('news_id')->unsigned();
                $table->string('title')->nullable();
                $table->mediumText('description')->nullable();
                //$table->schemalessAttributes('extra_data');
                $table->string('locale');
                $table->tinyInteger('enabled')->unsigned()->default(1);

                $table->unique(['news_id', 'locale']);
                $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
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
		Schema::drop('news_translations');
	}

}
