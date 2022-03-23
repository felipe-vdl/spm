<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimentoPericiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimento_pericias', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 96);
            $table->string('matricula', 7);
            $table->string('protocolo', 12);
            $table->string('local_lotacao', 64);
            $table->string('horario_trabalho', 14);
            $table->string('dt_inicio_atestado', 10);
            $table->string('email', 64);
            $table->tinyInteger('status');
            $table->string('direcionamento', 22);
            $table->string('data_agenda', 19);
            $table->string('hora_agenda', 5);
            $table->string('motivo_recusa', 96);
            $table->string('data_confirmacao', 20);
            $table->string('data_avaliacao', 20);
            $table->tinyInteger('envio_create')->nullable();
            $table->tinyInteger('envio_agenda')->nullable();
            $table->string('vinculo', 3);
            $table->timestamps();

            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimento_pericias');
    }
}
