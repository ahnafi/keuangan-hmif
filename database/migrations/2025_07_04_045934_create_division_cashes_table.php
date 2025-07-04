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
        Schema::create('division_cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("administrator_id")->constrained()->cascadeOnDelete();
            $table->foreignId("division_cash_access_id")->constrained()->cascadeOnDelete();
            $table->date("date");
            $table->string("work_program");
            $table->enum("type", ["income", "expense", "external_expense"]);
            $table->string("source");
            $table->bigInteger("amount");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_cashes');
    }
};
