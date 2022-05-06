<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Modules\Websites\Enum\WebsiteStatus;

class CreateWebsitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (! Schema::hasTable('websites')) {
            Schema::create('websites', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('owner_id')->unsigned()->nullable();
                $table->string('username')->nullable()->unique();
                $table->string('phoneNumber')->nullable();
                $table->string('logo')->nullable();
                $table->string('cover')->nullable();
                $table->string('watermark')->nullable();
                $table->string('schema')->default('http');
                $table->string('domain')->nullable()->unique();
                $table->string('theme')->default('default');
                $table->string('color')->default('main');
                $table->string('default_locale')->default('ar');
                $table->string('default_country')->default('eg');

                $table->integer('country_id')->unsigned()->nullable();
                $table->integer('province_id')->unsigned()->nullable();
                $table->integer('division_id')->unsigned()->nullable();
                $table->integer('area_id')->unsigned()->nullable();
                $table->text('address')->nullable();
                $table->text('google_map_url')->nullable();

                $table->string('webmasterMail')->nullable();
                $table->string('facebookUrl')->nullable();
                $table->string('twitterUrl')->nullable();
                $table->string('instagramUrl')->nullable();
                $table->string('whatsappUrl')->nullable();
                $table->string('telegramUrl')->nullable();
                $table->string('snapchatUrl')->nullable();
                $table->string('soundcloudUrl')->nullable();
                $table->string('youtubeUrl')->nullable();

                $table->schemalessAttributes('extra_attributes');
                $table->text('note')->nullable();

                $table->integer('created_by')->unsigned()->nullable();

                $table->timestamp('published_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
                //$table->tinyInteger('status')->unsigned()->default(WebsiteStatus::WaitingForReview);
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
		Schema::drop('websites');
	}

}
