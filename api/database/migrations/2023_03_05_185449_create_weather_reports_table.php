<?php

use App\Models\User;
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
        Schema::create('weather_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('short');
            $table->string('full');
            $table->decimal('temperature')->nullable();
            $table->decimal('perception')->nullable();
            $table->decimal('precipitation')->unsigned()->nullable();
            $table->decimal('humidity')->unsigned()->nullable();
            $table->decimal('wind')->unsigned()->nullable();
            $table->decimal('pressure')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_reports');
    }
};
