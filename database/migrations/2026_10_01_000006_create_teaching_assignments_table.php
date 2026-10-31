<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teaching_assignments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('weekly_hours');

            $table->timestamps();

            // Nama indeks unik dibuat lebih pendek
            $table->unique(
                ['teacher_id', 'subject_id', 'school_class_id'],
                'ta_teacher_subject_class_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teaching_assignments');
    }
};