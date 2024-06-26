<?php

use App\Models\Interest;
use App\Models\Student;
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
        Schema::create('interest_students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Interest::class)->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_students');
    }
};
