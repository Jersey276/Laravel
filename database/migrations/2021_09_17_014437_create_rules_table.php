<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->string('description')->nullable();
        });

        Schema::create('role_rule', function(Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->foreign('role_name')->references('name')->on('roles')->onDelete('cascade');

            $table->string('rule_name');
            $table->foreign('rule_name')->references('name')->on('rules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_rule');
        Schema::dropIfExists('rules');
    }
}
