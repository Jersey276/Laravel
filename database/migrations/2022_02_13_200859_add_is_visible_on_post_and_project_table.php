<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsVisibleOnPostAndProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('isVisible')->default(false);
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('isVisible')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {
            $table->dropColumn('isVisible');
        });

        Schema::table('projects', function(Blueprint $table) {
            $table->dropColumn('isVisible');
        });
    }
}
