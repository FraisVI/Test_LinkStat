<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('short_link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('short_link_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address', 45);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('short_link_clicks');
    }
};
