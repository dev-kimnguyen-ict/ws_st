<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUploadsAddReadyField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->string('type')->nullable()->after('mime');
            $table->dateTime('ready_at')->nullable()->after('updated_at');
            $table->string('error')->nullable()->after('mime');
            $table->unsignedInteger("uploadable_id")->nullable()->change();
            $table->string("uploadable_type")->nullable()->change();
            $table->dropSoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uploads', function (Blueprint $table) {
            $table->unsignedInteger('uploadable_id')->change();
            $table->string('uploadable_type')->change();
            $table->dropColumn('type');
            $table->dropColumn('error');
            $table->dropColumn('ready_at');
            $table->softDeletes();
        });
    }
}
