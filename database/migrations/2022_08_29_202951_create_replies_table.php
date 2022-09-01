<?php

use App\Models\User;
use App\Models\Thread;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Thread::class)->constrained();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('threads', function (Blueprint $table) {
            $table->unsignedBigInteger('resolved_by')->nullable();
            // $table->foreignId('resolved_by')->references('id')->on('replies');
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('replies');

        Schema::table('threads', function (Blueprint $table) {
            $table->dropColumn('resolved_by');
        });
    }
};
