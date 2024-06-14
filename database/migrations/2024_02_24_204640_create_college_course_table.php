<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('college_course', static function (Blueprint $table) {

            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('college_id')->constrained()->cascadeOnDelete();
            $table->boolean('published')->default(0);
            $table->unique([
                'course_id',
                'college_id'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_course');
    }
};
