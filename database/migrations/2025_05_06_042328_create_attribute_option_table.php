<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Option;
use App\Models\Attribute;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attribute_option', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Attribute::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Option::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->unique(['attribute_id', 'option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_option');
    }
};
