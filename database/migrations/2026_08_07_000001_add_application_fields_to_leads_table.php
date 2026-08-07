<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->text('gmina_reason')->nullable()->after('gmina');
            $table->string('business_sector')->nullable()->after('phone');
            $table->string('nip')->nullable()->after('business_sector');
            $table->text('knows_entrepreneurs')->nullable()->after('nip');
            $table->text('own_business')->nullable()->after('knows_entrepreneurs');
            $table->text('meeting_new_people')->nullable()->after('own_business');
            $table->text('organized_events')->nullable()->after('meeting_new_people');
            $table->text('handling_refusal')->nullable()->after('organized_events');
            $table->text('local_government_contacts')->nullable()->after('handling_refusal');
            $table->text('working_style')->nullable()->after('local_government_contacts');
            $table->text('weekly_time')->nullable()->after('working_style');
            $table->text('motivation')->nullable()->after('weekly_time');
            $table->text('confidentiality')->nullable()->after('motivation');
            $table->text('conflicts')->nullable()->after('confidentiality');
            $table->text('why_you')->nullable()->after('conflicts');
            $table->text('additional_info')->nullable()->after('why_you');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'gmina_reason',
                'business_sector',
                'nip',
                'knows_entrepreneurs',
                'own_business',
                'meeting_new_people',
                'organized_events',
                'handling_refusal',
                'local_government_contacts',
                'working_style',
                'weekly_time',
                'motivation',
                'confidentiality',
                'conflicts',
                'why_you',
                'additional_info',
            ]);
        });
    }
};
