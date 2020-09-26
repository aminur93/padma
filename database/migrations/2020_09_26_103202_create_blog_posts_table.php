<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->integer('sub_cat_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->text('image')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('publish');
            $table->tinyInteger('feature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
