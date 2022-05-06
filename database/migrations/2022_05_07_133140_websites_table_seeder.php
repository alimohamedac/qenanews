<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\Website;

class WebsitesTableSeeder extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up ()
	{
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        if (! DB::table('websites')->count()) {
            Website::create(
                [
                    'owner_id' => 1,
                    'domain' => config('app.domain'),
                    'username' => 'main',
                    'theme' => str_replace('frontend-', '', config('core.frontend-theme')),
                    'en' => ['title' => config('core.name')],
                    'ar' => ['title' => config('core.name')],
                    'webmasterMail' => config('core.webmaster-mail'),
                    'created_at' => now(),
                    'published_at' => now(),
                    'default_locale' => config('core.default-lang'),
                    //'status' => 1,
                ]
            );
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down ()
	{

	}

}
