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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            //$table->string('name');
            // $table->string('publication')->comment("انتشارات");
            // $table->string('writer')->comment('نویسنده ');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->nullable()->comment('is creator')->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->cacadeOndelete();
            $table->unsignedBigInteger('inventory')->default(0)->comment('موجودی');
            $table->boolean('published')->default(0);
            $table->decimal('price');
            $table->integer('pages')->comment('تعداد صفحات');
            $table->integer('sales')->comment('تعداد خرید ');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
