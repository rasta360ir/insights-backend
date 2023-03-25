<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('legal_title')->nullable();
            $table->string('known_as')->nullable();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('organizations')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('profile_type')->nullable();
            $table->string('ownership_type')->nullable();
            $table->string('business_model')->nullable();
            $table->string('ipo')->nullable();
            $table->string('num_employees')->nullable();
            $table->text('description')->nullable();
            $table->text('body')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('province_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('city_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('primary_address')->nullable();
            $table->string('secondary_address')->nullable();
            $table->integer('founded_year')->nullable();
            $table->integer('founded_month')->nullable();
            $table->integer('founded_day')->nullable();
            $table->integer('registered_year')->nullable();
            $table->integer('registered_month')->nullable();
            $table->integer('registered_day')->nullable();
            $table->integer('closed_year')->nullable();
            $table->integer('closed_month')->nullable();
            $table->integer('closed_day')->nullable();
            $table->string('imageUrl')->nullable();
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
        Schema::dropIfExists('organizations');
    }
};
