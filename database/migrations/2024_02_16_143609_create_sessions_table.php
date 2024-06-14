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
        Schema::create('sessions', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained()->cascadeOnDelete();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('ordering');
            $table->boolean('status')->default(0);
            $table->string('type');
            $table->time('start')->default('00:00');
            $table->time('end')->default('00:00');
            $table->date('date');
            $table->schemalessAttributes('extra_attributes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
