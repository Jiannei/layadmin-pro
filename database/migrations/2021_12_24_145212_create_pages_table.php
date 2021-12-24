<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePagesTable.
 */
class CreatePagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('pages', function(Blueprint $table) {
            $table->id();
            $table->string('uri')->unique();
            $table->string('title');
            $table->string('layout');
            $table->string('view');
            $table->json('styles')->nullable();
            $table->json('scripts')->nullable();
            $table->json('components')->nullable();
            $table->unsignedBigInteger('menu_id')->default(0);
            $table->string('status')->default(1);

            $table->unsignedBigInteger('creator_id')->default(0);
            $table->unsignedBigInteger('updater_id')->default(0);
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
		Schema::drop('pages');
	}
}
