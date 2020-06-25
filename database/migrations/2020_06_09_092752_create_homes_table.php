<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name', 50);
            $table->tinyInteger('n_rooms');
            $table->tinyInteger('n_beds');
            $table->tinyInteger('n_bath');
            $table->integer('mq');
            $table->text('long');
            $table->text('lat');
            // $table->text('description')->nullable();
            $table->string('address');
            $table->string('path')->default('https://picsum.photos/200/300');
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
        Schema::dropIfExists('homes');
    }
}
