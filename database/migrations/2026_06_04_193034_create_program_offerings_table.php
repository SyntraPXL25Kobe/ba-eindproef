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
        Schema::create('program_offerings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('campus_id')->constrained('educational_institution_campuses')->cascadeOnDelete();
            $table->foreignId('delivery_mode_id')->constrained('delivery_modes')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(
                ['program_id', 'campus_id', 'delivery_mode_id'],
                'po_program_campus_delivery_unique'
            );
            $table->index(['campus_id', 'delivery_mode_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_offerings');
    }
};
