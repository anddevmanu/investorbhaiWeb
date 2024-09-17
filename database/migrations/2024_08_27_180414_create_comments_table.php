<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('post_id')->nullable()->constrained('tbl_posts');
            $table->foreignId('answer_id')->nullable()->constrained('tbl_answers');
            $table->foreignId('blog_id')->nullable()->constrained('tbl_blogs');
            $table->string('type')->comment('Type of content: post, answer, blog');
            $table->longText('body');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
