<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGoodsSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_shares', function (Blueprint $table) {
            $table->dateTime('tpwd_create_time')->nullable();
            $table->string('tpwd',20)->default('')->nullable();
            $table->decimal('coupon_price',10,1)->default(0);
            $table->tinyInteger('is_recommend')->default(0);
            $table->string('coupon_info',60)->default('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
