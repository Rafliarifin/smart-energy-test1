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
    Schema::create('dashboard_data', function (Blueprint $table) {
        $table->id();
        $table->string('metric_name'); // e.g., 'Konsumsi Listrik', 'Rasio Elektrifikasi'
        $table->decimal('metric_value', 15, 2); // Nilai dari metrik tersebut
        $table->date('period_date'); // Tanggal yang merepresentasikan periode (misal, awal bulan)
        $table->string('source')->nullable(); // Untuk mencatat sumber data (BPS, ESDM, etc.)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_data');
    }
};
