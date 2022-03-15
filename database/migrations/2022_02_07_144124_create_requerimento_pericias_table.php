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
            $table->string('nome');
            $table->string('matricula');
            $table->string('protocolo');
            $table->string('local_lotacao');
            $table->string('horario_trabalho');
            $table->string('dt_inicio_atestado');
            $table->string('email');
            $table->integer('status');
            $table->string('direcionamento');
            $table->string('data_agenda');
            $table->string('hora_agenda');
            $table->string('motivo_recusa');
            $table->string('data_confirmacao');
            $table->string('data_avaliacao');
            $table->integer('envio_create')->nullable()->unsigned();
            $table->integer('envio_agenda')->nullable()->unsigned();
            $table->string('vinculo');
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
