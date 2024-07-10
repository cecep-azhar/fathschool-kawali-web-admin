<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class AddUuidToCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('qr_code_id')->unique()->after('id');
        });

    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('qr_code_id');
        });
    }
}
