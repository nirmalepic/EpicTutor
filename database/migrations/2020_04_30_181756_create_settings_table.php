<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->longText('about')->nullable();
            $table->longText('address')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->bigInteger('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('footer')->nullable();
            $table->string('background')->nullable();
            $table->string('theme_color')->nullable();
            $table->float('withdraw_fee')->nullable();
            $table->float('withdraw_charge')->nullable();
            $table->string('paypal_business')->nullable();
            $table->float('shipping_cost')->nullable();
            $table->string('stripe_key')->nullable();
            $table->string('stripe_secret')->nullable();
            $table->text('mobile_money')->nullable();
            $table->text('bank_wire')->nullable();
            $table->float('dynamic_commission')->nullable();
            $table->float('tax')->nullable();
            $table->float('fixed_commission')->nullable();
            $table->string('currency_sign')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('popular_tags')->nullable();
            $table->string('css_file')->nullable();
            $table->tinyInteger('stripe_status')->default('1');
            $table->tinyInteger('paypal_status')->default('1');
            $table->tinyInteger('mobile_status')->default('1');
            $table->tinyInteger('bank_status')->default('1');
            $table->tinyInteger('cash_status')->default('1');
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
        Schema::dropIfExists('settings');
    }
}
