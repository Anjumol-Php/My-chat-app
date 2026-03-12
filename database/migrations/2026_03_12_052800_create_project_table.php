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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('project')->default('NULL');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('Pending'); // Status കോളം ഇവിടെയാണ് കൊടുക്കുന്നത്
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
