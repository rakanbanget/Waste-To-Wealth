<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->timestamp('joined_at');
            $table->enum('role', ['admin', 'moderator', 'member']);
            $table->unique(['user_id', 'group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_members');
    }
};