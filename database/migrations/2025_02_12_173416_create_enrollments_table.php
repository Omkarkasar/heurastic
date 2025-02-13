<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studentid')->constrained('students')->onDelete('cascade');
            $table->foreignId('courseid')->constrained('courses')->onDelete('cascade');
            $table->date('enrollmentdate');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
