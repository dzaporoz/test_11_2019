<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('surname');
            $table->text('date-of-birth');
            $table->text('phone-number')->nullable(false)->unique();
            $table->text('email')->nullable(false)->unique();
            $table->text('password')->nullable(false);
            $table->text('address');
            $table->text('country');
            $table->integer('trading-account-number');
            $table->double('balance');
            $table->integer('open-trades');
            $table->integer('close-trades');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
