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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('primary_color')->default('#3B82F6')->after('favicon'); // Blue
            $table->string('secondary_color')->default('#10B981')->after('primary_color'); // Green
            $table->string('accent_color')->default('#F59E0B')->after('secondary_color'); // Amber
            $table->text('custom_css')->nullable()->after('accent_color');
            $table->string('election_banner')->nullable()->after('custom_css');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['primary_color', 'secondary_color', 'accent_color', 'custom_css', 'election_banner']);
        });
    }
};
