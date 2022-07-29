<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignIdFor(Comment::class)->nullable()->after('post_id');
        });
    }

    public function down() : void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('comment_id');
        });
    }
};
