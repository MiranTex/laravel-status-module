<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->string('defualt_name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create("status_groups", function (Blueprint $table){
            $table->uuid('id')->unique()->primary();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('status_group_items', function(Blueprint $table){
            $table->id();
            $table->uuid('status_id');
            $table->uuid('status_group_id');
            $table->integer('position');
            $table->string('custom_name')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() :void
    {
        Schema::dropIfExists('status_group_items');
        Schema::dropIfExists('status_groups');
        Schema::dropIfExists('statuses');
    }
};
