<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up() : void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('random_id')->index();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->text('excerpt');
            $table->unsignedInteger('certified_for_laravel')->nullable();
            $table->boolean('is_draft')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('posts');
    }
};
