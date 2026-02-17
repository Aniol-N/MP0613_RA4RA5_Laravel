<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->unsignedSmallInteger('year')->change();
        });
        DB::statement('ALTER TABLE films ADD CONSTRAINT check_year_range CHECK (year >= 1900 AND year <= 2024)');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE films DROP CONSTRAINT check_year_range');

        Schema::table('films', function (Blueprint $table) {
            $table->integer('year')->change();
        });
    }
};
