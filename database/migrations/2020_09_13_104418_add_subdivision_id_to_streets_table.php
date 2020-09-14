<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubdivisionIdToStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('streets', function (Blueprint $table) {
            $table->foreignId('ward_id');
            $table->foreignId('district_id');
            $table->foreignId('province_id');
        });
        DB::update('update streets set ward_id = 31144');
        DB::update('update streets set district_id = 916');
        DB::update('update streets set province_id = 92');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('streets', function (Blueprint $table) {
            $table->dropColumn('ward_id');
            $table->dropColumn('district_id');
            $table->dropColumn('province_id');
        });
    }
}
