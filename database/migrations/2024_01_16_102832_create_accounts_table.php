<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Назва облікового запису
            $table->string('website'); // Веб-сайт облікового запису
            $table->string('phone'); // Телефон облікового запису
            $table->timestamps(); // Автоматично додає поля "created_at" та "updated_at"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
