<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoordinatesToInstitutionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('address');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
}

