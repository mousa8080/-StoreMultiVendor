<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {

            $table->id(); //=// $table->bigInteger('id')->primary();
            // $table->unsignedBigInteger('id')->autoIncrement()->primary();
            // $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            //created_at and updated_at (timestaps)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
