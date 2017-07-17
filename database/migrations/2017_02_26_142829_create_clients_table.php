<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('company_activity');
            $table->string('company_address');
            $table->string('company_register_number');
            $table->date('company_register_expiration');
            $table->string('company_apparent_capital');
            $table->string('company_money_capital');
            $table->string('company_total_capital');
            $table->enum('company_type', ['individual', 'limited', 'solidarity', 'contributory']);
            $table->enum('company_zakkat', ['zakkat', 'tax', 'mixed']);
            $table->integer('manager_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('clients');
    }

}
