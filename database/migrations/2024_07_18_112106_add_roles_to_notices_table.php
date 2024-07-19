<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<<< HEAD:database/migrations/2024_07_18_105145_add_photo_to_courses_table.php
return new class extends Migration
========
class AddRolesToNoticesTable extends Migration
>>>>>>>> a573c28c12a828bd37ba5c78370e6eaaec6593d5:database/migrations/2024_07_18_112106_add_roles_to_notices_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<<< HEAD:database/migrations/2024_07_18_105145_add_photo_to_courses_table.php
        Schema::table('courses', function (Blueprint $table) {
            $table->string('photo')->nullable();
========
        Schema::table('notices', function (Blueprint $table) {
            $table->enum('roles', ['Student', 'Teacher', 'Parent', 'Accountant'])->nullable()->after('status');
>>>>>>>> a573c28c12a828bd37ba5c78370e6eaaec6593d5:database/migrations/2024_07_18_112106_add_roles_to_notices_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<<< HEAD:database/migrations/2024_07_18_105145_add_photo_to_courses_table.php
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('photo');
========
        Schema::table('notices', function (Blueprint $table) {
            $table->dropColumn('roles');
>>>>>>>> a573c28c12a828bd37ba5c78370e6eaaec6593d5:database/migrations/2024_07_18_112106_add_roles_to_notices_table.php
        });
    }
};
