<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('email');
            $table->boolean('active')->default(true);

            $table->unique(['email']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
