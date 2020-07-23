<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('contact')->nullable();
            $table->text('contact_email')->nullable();
            $table->longText('about')->nullable();
            $table->longText('faq')->nullable();
            $table->string('large_banner')->nullable();
            $table->text('banner_link')->nullable();
            $table->tinyInteger('c_status')->default('0');
            $table->tinyInteger('a_status')->default('0');
            $table->tinyInteger('f_status')->default('0');
            $table->tinyInteger('slider_status')->default('1');
            $table->tinyInteger('category_status')->default('1');
            $table->tinyInteger('sbanner_status')->default('1');
            $table->tinyInteger('latestpro_status')->default('1');
            $table->tinyInteger('featuredpro_status')->default('1');
            $table->tinyInteger('lbanner_status')->default('1');
            $table->tinyInteger('popularpro_status')->default('1');
            $table->tinyInteger('blogs_status')->default('1');
            $table->tinyInteger('brands_status')->default('1');
            $table->tinyInteger('testimonial_status')->default('1');
            $table->tinyInteger('subscribe_status')->default('1');
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
        Schema::dropIfExists('page_settings');
    }
}
