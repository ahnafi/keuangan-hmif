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
        Schema::create('deposit_penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId("deposit_id")->constrained()->cascadeOnDelete();
            $table->date("date");
            $table->enum("detail", ["plenary_meeting", "jacket_day", "graduation_ceremony", "secretariat_maintenance", "work_program", "other"]);
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
        Schema::dropIfExists('deposit_penalties');
    }
};
