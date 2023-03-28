<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();

            $table->json('old_value')->nullable();
            $table->json('new_value')->nullable();

            $table->timestamps();

            $table->morphs('auditable');

            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('audits');
    }
};