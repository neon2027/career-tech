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
        Schema::create('quiz_personality_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_result_id')->constrained('quiz_results')->cascadeOnDelete();
            $table->foreignId('personality_type_id')->constrained('personality_types')->cascadeOnDelete();
            $table->integer('total_score');
            $table->integer('max_possible_score');
            $table->decimal('percentage', 5, 2); // percentage score (0.00 to 100.00)
            $table->timestamps();

            $table->unique(['quiz_result_id', 'personality_type_id'], 'quiz_scores_result_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_personality_scores');
    }
};
