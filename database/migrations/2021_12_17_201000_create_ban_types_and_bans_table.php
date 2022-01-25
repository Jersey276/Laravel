<?php

use App\Models\BanType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanTypesAndBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('ban_types')) {
            Schema::create('ban_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug');
                $table->string('duration')->nullable();
                $table->text('description');
                $table->boolean('isDefinitive');
            });
        }
        if (!Schema::hasTable('bans')) {
            Schema::create('bans', function (Blueprint $table) {
                $table->id();
                $table->boolean('isActive');
                $table->foreignId('ban_types_id');
                $table->foreign('ban_types_id')->references('id')->on('ban_types')->onDelete('cascade');

                $table->dateTime('startedAt');
                $table->dateTime('endedAt')->nullable();
                $table->foreignId('user_ban');
                $table->foreign('user_ban')->references('id')->on('users')->cascadeOnDelete();
                $table->foreignId('user_judge')->nullable();
                $table->foreign('user_judge')->references('id')->on('users')->nullOnDelete();
                $table->text('commentary')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bans');
        Schema::dropIfExists('ban_types');
    }
}
