<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stage_agreement_id'); // Поле для ідентифікатора етапу угоди
            $table->string('name'); // Назва угоди
            $table->timestamps();

            // Зовнішній ключ, який посилається на поле id таблиці stageAgreements
            $table->foreign('stage_agreement_id')
                ->references('id')
                ->on('stageAgreements')
                ->onDelete('cascade'); // Видалення пов'язаних записів при видаленні етапу угоди
        });

        // Перевірка, чи існує колонка name в таблиці stageAgreements
        if (!Schema::hasColumn('stageAgreements', 'name')) {
            Schema::table('stageAgreements', function (Blueprint $table) {
                // Додаємо поле name до таблиці stageAgreements
                $table->string('name')->nullable();
            });
        }
    }
    public function down()
    {
        Schema::dropIfExists('deals');

        Schema::table('stageAgreements', function (Blueprint $table) {
            // Видаляємо поле name з таблиці stageAgreements
            $table->dropColumn('name');
        });
    }
};
