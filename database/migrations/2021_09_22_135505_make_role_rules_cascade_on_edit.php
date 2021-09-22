<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeRoleRulesCascadeOnEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_name_foreign');
            $table->foreign('role_name')->references('name')->on('roles')->onUpdate('cascade');
        });

        Schema::table('role_rule', function (Blueprint $table) {
            $table->dropForeign('role_rule_role_name_foreign');
            $table->foreign('role_name')->references('name')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_name_foreign');
            $table->foreign('role_name')->references('name')->on('roles');
        });

        Schema::table('role_rule', function (Blueprint $table) {
            $table->dropForeign('role_rule_role_name_foreign');
            $table->foreign('role_name')->references('name')->on('roles')->onDelete('cascade');
        });
    }
}
