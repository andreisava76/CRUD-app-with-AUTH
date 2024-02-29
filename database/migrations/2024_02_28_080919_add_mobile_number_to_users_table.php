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
        Schema::table('users', function (Blueprint $table) {
           $table->string('mobile_number')->nullable()->after('email');
           $table->timestamp('mobile_verified_at')->nullable()->after('mobile_number');
           $table->string('mobile_verify_code')->nullable()->after('mobile_verified_at');
            $table->tinyInteger('mobile_attempts_left')->default(0)->after('mobile_verify_code');
            $table->timestamp('mobile_last_attempt_date')->nullable()->after('mobile_attempts_left');
            $table->timestamp('mobile_verify_code_sent_at')->nullable()->after('mobile_last_attempt_date');
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
            $table->dropColumn('mobile_number');
            $table->dropColumn('mobile_verified_at');
            $table->dropColumn('mobile_verify_code');
            $table->dropColumn('mobile_attempts_left');
            $table->dropColumn('mobile_last_attempt_date');
            $table->dropColumn('mobile_verify_code_sent_at');
        });
    }
};
