<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsShareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->default("");
            $table->string('title')->default("");
            $table->integer('category_id')->default(0);;
            $table->string('from_site',30)->default("");
            $table->decimal('price',10,1)->default(0);
            $table->string('click_url',500)->default("");
            $table->text('detail')->default("")->nullable();
            $table->string('keywords')->default("")->nullable();
            $table->string('description')->default("")->nullable();
            $table->string('original_id',20)->default(0);
            $table->string('cover')->default("")->nullable();
            $table->text('pictures')->default("")->nullable();
            $table->string('item_url')->default("");
            $table->decimal('subject',3,2)->default(0)->nullable();
            $table->integer('subject_count')->default(0)->nullable();
            $table->string('coupon_click_url',500)->default("")->nullable();
            $table->date('coupon_start_time')->nullable();
            $table->date('coupon_end_time')->nullable();
            $table->decimal('coupon_amount',10,2)->default(0);
            $table->decimal('coupon_start_fee',10,2)->default(0);
            $table->integer('coupon_remain_count')->default(0);
            $table->tinyInteger('coupon_status')->default(0);
            $table->integer('view')->default(0);
            $table->integer('volume')->default(0);
            $table->integer('channel_id')->default(0);
            $table->tinyInteger('status')->default(1);

        });
        Schema::create('ads',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('position',60)->default("");
            $table->integer('category_id')->default(0);
            $table->string('url')->default("");
            $table->string('cover')->default("");
            $table->string('name',60)->default("");
            $table->tinyInteger('type')->default(0);
        });

        Schema::create('categories',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('icon')->default("");
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('hidden')->default(0);
            $table->string('name')->default("");
        });


        Schema::create('channels',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->default("");
            $table->string('cover')->default("");
            $table->integer('parent_id')->default(0);
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('hidden')->default(0);
        });
        Schema::create('files',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('name',60)->default("");
            $table->string('path')->default("");
            $table->string('original_name')->default("");
            $table->string('md5')->default("");
            $table->integer('size')->default(0);
            $table->char('ext',10)->default("");
            $table->tinyInteger('status')->default(1);
        });

        Schema::create('navs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default("");
            $table->string('link')->default("");
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::create('schedule_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default("");
            $table->string('md5')->default("");
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
        Schema::dropIfExists('goods_share');
    }
}
