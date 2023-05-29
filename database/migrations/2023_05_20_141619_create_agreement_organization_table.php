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
        Schema::create('agreement_organization', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('agreement_id');
            $table->foreign('agreement_id')->references('id')
                ->on('agreements')->onDelete('CASCADE');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')
                ->on('organizations')->onDelete('CASCADE');

            $table->integer('party');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agreement_organization');
    }
};
