<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            
            $table->date('date_debut')->nullable();  // Add start date
            $table->date('date_fin')->nullable();    // Add end date
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([ 'date_debut', 'date_fin']);
        });
    }
};
