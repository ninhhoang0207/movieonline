<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');//ten phim
            $table->text('content')->nullable();//noi dung cua phim
            $table->date('date')->nullable();//thoi gian xuat ban
            $table->double('imdb')->nullable()->default(0);//diem imdb
            $table->integer('length')->nullable()->default(0);//do dai cua phim
            $table->integer('views')->nullable()->default(0);//luot xem
            $table->text('companies')->nullable();//con ty san xuat
            $table->text('directors')->nullable();//dao dien san xuat phim
            $table->string('trailer')->nullable();//video trailer cua phim
            $table->integer('likes')->nullable()->default(0);//luot thich
            $table->integer('rates')->nullable()->default(0);//luot thich
            $table->integer('type')->nullable()->default(0);//the loai 0 = phim le, != 0 phim bo
            $table->string('quality')->nullable();//chat luong phim
            $table->string('image')->nullable();//anh tieu de
            $table->string('picture')->nullable();//anh tieu de
            $table->string('url')->nullable();//duong dan luu phim
            $table->integer('countries_id')->references('id')->on('countries');
            $table->timestamps();//Thoi gian upload
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
}
