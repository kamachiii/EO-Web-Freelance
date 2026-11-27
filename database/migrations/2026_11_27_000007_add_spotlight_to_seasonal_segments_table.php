<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Konten sorotan musim untuk beranda publik (docs/SEASONAL.md bagian 8).
     */
    public function up(): void
    {
        Schema::table('seasonal_segments', function (Blueprint $table) {
            $table->unsignedSmallInteger('priority')->default(0)->after('sort_order');
            $table->text('hero_subheadline')->nullable()->after('description');
            $table->string('spotlight_title', 160)->nullable()->after('hero_subheadline');
            $table->text('spotlight_description')->nullable()->after('spotlight_title');
            $table->string('cta_label', 80)->nullable()->after('spotlight_description');
            $table->text('whatsapp_message')->nullable()->after('cta_label');
            $table->json('featured_service_ids')->nullable()->after('whatsapp_message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seasonal_segments', function (Blueprint $table) {
            $table->dropColumn([
                'priority',
                'hero_subheadline',
                'spotlight_title',
                'spotlight_description',
                'cta_label',
                'whatsapp_message',
                'featured_service_ids',
            ]);
        });
    }
};
