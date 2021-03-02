<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0);
            $table->integer('brand_id')->default(0);
            $table->string('name');
            $table->text("description")->default('');
            $table->text('content')->default('');
            $table->text('tags')->nullable();
            $table->text('tags_slug')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('price')->default(0);
            $table->boolean("status")->default(true);
            $table->string("url")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_product');
    }
}
