<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_number')->nullable()->after('email_verified_at');
            $table->timestamp('mobile_verified_at')->nullable()->after('mobile_number');
            $table->string('verification_code')->nullable()->after('mobile_verified_at');
            $table->timestamp('verification_code_sent_at')->nullable()->after('verification_code');
            $table->tinyInteger('attempts_left')->default(0)->after('verification_code_sent_at');
            $table->timestamp('last_attempt_date')->nullable()->after('attempts_left');
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
            $table->dropColumn('verification_code');
            $table->dropColumn('verification_code_sent_at');
            $table->dropColumn('attempts_left');
            $table->dropColumn('last_attempt_date');
        });
    }
};
