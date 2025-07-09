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
        Schema::create('cash_fund', function (Blueprint $table) {
            $table->id();
            $table->foreignId("fund_id")->constrained()->cascadeOnDelete();
            $table->foreignId("cash_id")->constrained()->cascadeOnDelete();
            $table->date("date");
            $table->string("month");
            $table->integer("penalty");
            $table->integer("cash");
            $table->integer("amount");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_fund');
    }
};
