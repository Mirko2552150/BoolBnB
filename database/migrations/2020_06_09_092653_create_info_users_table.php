<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_users', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->string('name', 50)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('path')->default('https://lh3.googleusercontent.com/proxy/UWQ9fvSSWZMCwJqLXZCAWzrjj6uZiDZUGahqRh06JrpddXhi1DXjTrvAZcnf65XTIf_HLy8BGTptu6j4_RNI1fAL0y5f3-9mSo3tWC2-I91HuMZbvexqOarSMactNlRg-tRC28w');
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
        Schema::dropIfExists('info_users');
    }
}
