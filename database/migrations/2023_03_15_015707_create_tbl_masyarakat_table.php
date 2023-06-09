<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasyarakatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_masyarakat', function (Blueprint $table) {
            $table->char('nik', 16)->primary();
            $table->string('nama', 35);
            $table->string('username', 26)->unique();
            $table->string('password');
            $table->string('telp', 13);
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
        Schema::dropIfExists('tbl_masyarakat');
    }
}
