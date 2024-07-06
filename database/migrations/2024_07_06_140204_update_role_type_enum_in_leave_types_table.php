<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ganti ENUM menggunakan raw SQL
        DB::statement("ALTER TABLE leave_types MODIFY role_type ENUM('Student', 'Teacher', 'Parent', 'Admin') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Kembalikan ke ENUM asli menggunakan raw SQL
        DB::statement("ALTER TABLE leave_types MODIFY role_type ENUM('student', 'staff') NOT NULL");
    }
};
