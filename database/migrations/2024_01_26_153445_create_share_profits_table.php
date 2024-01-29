<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareProfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_profits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('profit_persen_member')->nullable();
            $table->string('profit_persen_mitra')->nullable();
            $table->string('profit_persen_pionir')->nullable();
            $table->string('profit_persen_nm')->nullable();
            $table->string('profit_persen_snm')->nullable();
            $table->string('profit_persen_jd')->nullable();
            $table->string('profit_persen_director')->nullable();
            $table->string('profit_persen_sd')->nullable();
            $table->string('profit_persen_pd')->nullable();
            $table->string('profit_persen_retirement')->nullable();
            $table->string('profit_nominal_member')->nullable();
            $table->string('profit_nominal_mitra')->nullable();
            $table->string('profit_nominal_pionir')->nullable();
            $table->string('profit_nominal_nm')->nullable();
            $table->string('profit_nominal_snm')->nullable();
            $table->string('profit_nominal_jd')->nullable();
            $table->string('profit_nominal_director')->nullable();
            $table->string('profit_nominal_sd')->nullable();
            $table->string('profit_nominal_pd')->nullable();
            $table->string('profit_nominal_retirement')->nullable();
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
        Schema::dropIfExists('share_profits');
    }
}
