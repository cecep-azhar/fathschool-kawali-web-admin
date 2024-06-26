<?php

use App\Models\ChatGroup;
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
        Schema::create('chat_group_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ChatGroup::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('sender_user_id');
            $table->longText('message')->nullable();
            $table->string('file')->nullable();
            $table->string('file_type')->nullable();
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
        Schema::dropIfExists('chat_group_conversations');
    }
};
