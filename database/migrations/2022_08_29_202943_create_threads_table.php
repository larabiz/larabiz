<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->string('random_id')->index();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('title')->unique();
            $table->string('slug');
            $table->text('content');
            $table->timestamp('last_activity_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('threads');
    }
};
