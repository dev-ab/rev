<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrialBalances extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('trial_balances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('work_point_id')->unsigned();
            $table->string('name');
            $table->float('initial_debit', 8, 4);
            $table->float('initial_credit', 8, 4);
            $table->float('move_debit', 8, 4);
            $table->float('move_credit', 8, 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('trial_balances');
    }

}
