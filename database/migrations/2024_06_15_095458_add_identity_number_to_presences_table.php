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
    Schema::table('presences', function (Blueprint $table) {
      // $table->string('identity_number')->after('nik');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('presences', function (Blueprint $table) {
      // $table->dropColumn('identity_number');
    });
  }
};
