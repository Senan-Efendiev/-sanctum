<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('developers', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('developers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('genres', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
