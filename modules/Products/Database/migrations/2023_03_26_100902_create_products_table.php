<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->decimal('price', 8, 2);
            $table->tinyInteger('status')->default(0)->nullable()->comment('0=Inactive,1=Active');
            $table->tinyInteger('type')->default(0)->nullable()->comment('0=Item,1=Service');

            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
