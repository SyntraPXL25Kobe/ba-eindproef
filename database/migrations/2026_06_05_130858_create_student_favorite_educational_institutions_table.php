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
        Schema::create('student_favorite_educational_institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_profile_id')->constrained('student_profiles')->name('sfei_student_profile_id_foreign')->cascadeOnDelete();
            $table->foreignId('educational_institution_id')->constrained('educational_institutions')->name('sfei_educational_institution_id_foreign')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_favorite_educational_institutions');
    }
};
