<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('params', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('type')->default(0); 
      $table->string('value_string')->nullable();
      $table->integer('value_int')->nullable();
      $table->float('value_float')->nullable();
      $table->boolean('value_bool')->nullable();
      $table->json('value_json')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('params');
  }
};
