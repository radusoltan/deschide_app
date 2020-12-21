<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');

            $table->string('title');
            $table->string('slug');
            $table->text('lead')->nullable(true);
            $table->text('content')->nullable(true);
            $table->string('locale')->index();

            $table->unique(['article_id','locale']);

            $table->foreign('article_id')
                ->references('id')
                ->on('articles')
                ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_translations');
    }
}
