<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->after('title');
            $table->string('seo_excerpt')->nullable()->after('excerpt');
        });
    }

    public function down() : void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['seo_title', 'seo_excerpt']);
        });
    }
};
