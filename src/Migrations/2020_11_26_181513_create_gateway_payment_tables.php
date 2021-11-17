<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGatewayPaymentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_status', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $this->insertPaymentSatus();

        Schema::create('payment', function(Blueprint $table){
            $table->id();
            $table->integer('amount');
            $table->integer('discount')->default(0);
            $table->integer('fees_number')->nullable()->default(1);
            $table->integer('fee_amount')->nullable()->default(0);
            $table->string('payment_class')->nullable();
            $table->bigInteger('payment_status_id')->unsigned()->default(1);
            $table->foreign('payment_status_id')->references('id')->on('payment_status')->onDelete('CASCADE')->onUpdate('CASCADE');;
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
        Schema::dropIfExists('payment');
        Schema::dropIfExists('payment_status');
    }

    private function insertPaymentSatus(){
        DB::table('payment_status')->insert([
            ['name' => 'Pending'],
            ['name' => 'Accepted'],
            ['name' => 'Rejected']
        ]);
    }
}
