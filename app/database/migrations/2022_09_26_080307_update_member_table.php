<?php

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
       Schema::table("member", function ( Blueprint $table){
          $table->string("image_relative_url", 250)->nullable();
          $table->string("zipcode", 20)->nullable();
          $table->boolean("is_active")->nullable(false)->default(true);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("member", function ( Blueprint $table){
            $table->dropColumn("image_relative_url");
            $table->dropColumn("zipcode");
            $table->dropColumn("is_active");
        });
    }
};
