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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('investment_type')->nullable();
            $table->string('stock')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->text('description')->nullable();
            $table->text('references')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->text('comment')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('agreements');
    }
};
