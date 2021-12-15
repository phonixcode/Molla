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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('full_name');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            // $table->enum('role', ['admin', 'seller', 'customer'])->default('customer');
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->text('country')->nullable();
            $table->text('city')->nullable();
            $table->text('postcode')->nullable();
            $table->text('state')->nullable();
            $table->text('address')->nullable();

            $table->text('s_country')->nullable();
            $table->text('s_city')->nullable();
            $table->text('s_postcode')->nullable();
            $table->text('s_state')->nullable();
            $table->text('s_address')->nullable();

            $table->rememberToken();
            $table->softDeletes();
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
