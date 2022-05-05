<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('local');
                $table->string('key');
                $table->string('value');
                $table->timestamps();
            });
        }
        /*ex
        DB::table('settings')->insert([
            'local'        => 'ar',
            'key'          => 'youtube_url',
            'value'        => 'https://youtu.be/oSbt5sfzlkw',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
