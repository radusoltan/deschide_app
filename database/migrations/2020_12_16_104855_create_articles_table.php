<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');

            $table->boolean('is_breaking')->default(false);
            $table->boolean('is_flash')->default(false);
            $table->boolean('is_alert')->default(false);

            $table->string('status',5);
            $table->string('type', 20);

            $table->timestamps();
            $table->timestamp('publish_at')->nullable(true)->default(null);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
