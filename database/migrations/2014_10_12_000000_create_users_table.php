<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('no_hp');
            $table->string('referal');
            $table->string('by_referal')->nullable();
            $table->string('referal_1')->nullable();
            $table->string('referal_2')->nullable();
            $table->string('referal_3')->nullable();
            $table->string('referal_4')->nullable();
            $table->string('role');
            $table->string('level')->nullable();
            $table->string('email')->unique();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->string('no_rekening')->unique()->nullable();
            $table->string('atas_nama')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('poin')->nullable();
            $table->string('saldo')->nullable();
            $table->enum('status_akun', ['Member', 'Calon Member', 'Admin']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
