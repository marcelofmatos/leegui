<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePortainerServersLogsUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portainer_servers', function (Blueprint $table) {
            $table->string('logs_url', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // error Class 'Doctrine\DBAL\Driver\PDOSqlite\Driver' not found 
        // composer require doctrine/dbal
        //Schema::table('portainer_servers', function (Blueprint $table) {
        //    $table->dropColumn('logs_url');
        //});
    }
}
