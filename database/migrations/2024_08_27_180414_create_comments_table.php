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
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('post_id')->constrained('tbl_posts')->nullable();
            $table->foreignId('answer_id')->constrained('tbl_answers')->nullable();
            $table->foreignId('blog_id')->constrained('tbl_blogs')->nullable();
            $table->string('type'); // Type of comment (post, answer, blog)
            $table->longText('body'); // Comment body
            $table->tinyInteger('status')->default(1); // Status of the comment
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
