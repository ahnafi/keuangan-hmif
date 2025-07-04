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
        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("administrator_id")->constrained()->cascadeOnDelete();
            $table->integer("april")->default(0);
            $table->integer("may")->default(0);
            $table->integer("june")->default(0);
            $table->integer("july")->default(0);
            $table->integer("august")->default(0);
            $table->integer("september")->default(0);
            $table->integer("october")->default(0);
            $table->integer("november")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashes');
    }
};
