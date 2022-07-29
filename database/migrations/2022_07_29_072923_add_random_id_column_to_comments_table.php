<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->string('random_id')->unique()->index()->after('id');
        });
    }

    public function down() : void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('random_id');
        });
    }
};
