->nullable()<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('word')->nullable();
            $table->longText('english')->nullable();
            $table->longText('spanish')->nullable();
            $table->longText('srench')->nullable();
            $table->longText('chinese')->nullable();
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
        Schema::dropIfExists('site_languages');
    }
}
