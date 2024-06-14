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
        Schema::create('terms', static function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            //TableTermsFieldOrderingEnum::class
            $table->string('ordering');//ترم چندم
            $table->boolean('assessment');
            $table->string('prerequisite_id')->nullable();
            $table->schemalessAttributes('extra_attributes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
