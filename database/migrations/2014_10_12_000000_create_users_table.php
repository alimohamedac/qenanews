<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->index();
                $table->string('email')->nullable()->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('phoneNumber')->nullable()->unique();
                $table->string('password');
                $table->string('uniqueKey')->unique();
                $table->rememberToken();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->text('bio')->nullable();
                $table->string('gender')->default('male');
                $table->integer('country_id')->unsigned()->nullable();
                $table->integer('province_id')->unsigned()->nullable();
                $table->integer('division_id')->unsigned()->nullable();
                $table->integer('area_id')->unsigned()->nullable();
                $table->mediumText('address')->nullable();
                $table->string('photo')->nullable();
                $table->date('dateOfBirth')->nullable();

                $table->string('facebookUrl')->nullable();
                $table->string('whatsappNumber')->nullable();
                $table->string('twitterUrl')->nullable();
                $table->string('instagramUrl')->nullable();
                $table->text('note')->nullable();
                $table->schemalessAttributes('extra_attributes');
                $table->tinyInteger('isConfirmed')->unsigned()->default(1);
                $table->tinyInteger('isProtected')->unsigned()->default(0);
                $table->tinyInteger('status')->unsigned()->default(1)->index();
                $table->softDeletes();
                $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
