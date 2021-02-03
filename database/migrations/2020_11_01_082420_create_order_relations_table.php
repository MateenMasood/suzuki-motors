<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_relations', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('enquiry_id')->nullable();
            $table->integer('extended_warranty_id')->nullable();
            $table->integer('insurance_program_id')->nullable();
            $table->integer('registration_fee_id')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->integer('corporate_id')->nullable();
            $table->integer('product_hold_id')->nullable();
            $table->enum('status',['0','1'])->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('order_relations');
    }
}
