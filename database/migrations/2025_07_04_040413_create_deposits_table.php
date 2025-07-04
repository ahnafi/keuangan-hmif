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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId("administrator_id")->constrained()->cascadeOnDelete();
            $table->integer("plenary_meeting")->nullable()->default(0);
            $table->integer("jacket_day")->nullable()->default(0);
            $table->integer("graduation_ceremony")->nullable()->default(0);
            $table->integer("secretariat_maintenance")->nullable()->default(0);
            $table->integer("work_program")->nullable()->default(0);
            $table->integer("other")->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
