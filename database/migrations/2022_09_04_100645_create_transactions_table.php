<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('user_email');
            $table->decimal('paid_amount',5,2)->nullable();
            $table->string('currency')->nullable();
            $table->enum('status',['authorized','decline','refunded'])->default('authorized')->nullable();
            $table->dateTime('payment_date');
            $table->timestamps();

            $table->index('user_email');
            $table->foreign('user_email')
                ->references('email')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
