<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('invoice_no');
            $table->timestamp('date');
            $table->string('due_date_in')->nullable()->comment('last paying date');
            $table->timestamp('due_date')->nullable();
            $table->longText('message')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->decimal('amount', 9, 2);

            // about recurring
            $table->boolean('recurring')->default(false);
            $table->boolean('recurring_status')->default(false);
            $table->timestamp('recurring_date')->nullable();
            $table->string('currency');
            $table->unsignedInteger('recurring_days')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
