<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleArticletagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_articletag', function (Blueprint $table) {
            $table->primary(['article_id', 'articletag_id']);            
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->foreignId('articletag_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_articletag');
    }
}
