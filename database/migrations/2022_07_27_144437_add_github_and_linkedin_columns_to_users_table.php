<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('github')->nullable()->after('username');
            $table->string('linkedin')->nullable()->after('github');
        });
    }

    public function down() : void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('github');
            $table->dropColumn('linkedin');
        });
    }
};
