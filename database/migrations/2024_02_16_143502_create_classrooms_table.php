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
        Schema::create('classrooms', static function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('college_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('term_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('term_date_id')->constrained('term_dates')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->string('classroom_gender');
            $table->date('start');
            $table->date('end');
            $table->string('type');//Enums/TableClassroomFieldTypeEnum
            $table->integer('sort');
            $table->integer('capacity');
            $table->boolean('published');
            $table->schemalessAttributes('extra_attributes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
