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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->decimal('budget', 12, 2)->nullable();
            $table->string('source')->nullable();

            $table->enum('status', [
                'new',
                'qualified',
                'contacted',
                'proposal_sent',
                'won',
                'lost'
            ])->default('new');

            $table->integer('score')->default(0);

            $table->text('requirements')->nullable();
            $table->text('ai_summary')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
