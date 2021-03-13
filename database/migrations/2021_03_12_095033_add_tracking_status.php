<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrackingStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consignments', function (Blueprint $table) {
            $table->string('tracking_status')->after('tracking_link')->default(0);
            $table->string('tracking_provider')->after('tracking_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consignments', function (Blueprint $table) {
            //
        });
    }
}
