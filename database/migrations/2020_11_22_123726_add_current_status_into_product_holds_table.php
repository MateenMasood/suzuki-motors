<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

class AddCurrentStatusIntoProductHoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_holds', function (Blueprint $table) {
            $table->string('current_status')->after('description')->default(Config::get('constants.product_hold'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_holds', function (Blueprint $table) {
            $table->dropColumn('current_status');
        });
    }
}
