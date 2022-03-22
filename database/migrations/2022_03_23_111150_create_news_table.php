<?php

use App\Enum\NewsStatus;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('news', function(Blueprint $table){
			$table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users');
			$table->string('author')->nullable();

            $table->string('type')->default('article');
			$table->string('default_locale')->default('ar');
			$table->string('slug')->nullable()->index();

			$table->string('photo')->nullable();
			$table->text('photo_description')->nullable();
            $table->string('cover')->nullable();
            $table->string('media_url')->nullable();
            $table->text('embed')->nullable();
            //$table->text('google_map_url')->nullable();
            $table->text('source_url')->nullable();

			$table->bigInteger('visits')->unsigned()->default(0)->index();

            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('division_id')->unsigned()->nullable();
            $table->integer('area_id')->unsigned()->nullable();
            $table->text('address')->nullable();

           // $table->schemalessAttributes('extra_attributes');

			$table->tinyInteger('showInHomePage')->unsigned()->default(1);
            $table->tinyInteger('is_pinned')->unsigned()->default(0);
            $table->tinyInteger('is_special')->unsigned()->default(0);
			//$table->tinyInteger('allowVotes')->unsigned()->default(1);
			$table->tinyInteger('allowComments')->unsigned()->default(1);

            $table->integer('created_by')->unsigned()->nullable();
                $table->foreign('created_by')->references('id')->on('users');
			$table->timestamp('published_at')->nullable()->index();
			$table->timestamps();
			$table->softDeletes();
			$table->tinyInteger('isProtected')->unsigned()->default(0);
			$table->enum('status', [NewsStatus::Deleted, NewsStatus::Enabled, NewsStatus::Disabled, NewsStatus::Pending])->default(NewsStatus::Enabled);
            $table->unique('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news');
	}

}
