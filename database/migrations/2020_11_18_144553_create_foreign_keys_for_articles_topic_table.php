<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysForArticlesTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles_topic', function (Blueprint $table) {
            $table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles_topic', function (Blueprint $table) {
            $table->dropForeign('articles_topic_topic_id_foreign');
            $table->dropForeign('articles_topic_articles_id_foreign');
        });
    }
}
