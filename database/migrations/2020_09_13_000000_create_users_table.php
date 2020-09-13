<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('username')->unique()->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'superuser', 'user', 'enduser'])->default('enduser');
            $table->enum('status', ['active', 'suspended', 'closed'])->default('active');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name')->nullable();
            $table->text('profile_image')->nullable();
            $table->string('oauth_provider')->nullable();
            $table->string('oauth_id')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
