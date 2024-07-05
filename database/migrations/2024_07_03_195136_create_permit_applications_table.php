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
        Schema::create('permit_applications', function (Blueprint $table) {
            $table->id();
            $table->char('identity_number', 20);
            $table->date('permit_date');
            $table->char('status', 1);
            $table->string('information')->nullable();
            $table->char('status_approved', 1)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permit_applications');
    }
};
