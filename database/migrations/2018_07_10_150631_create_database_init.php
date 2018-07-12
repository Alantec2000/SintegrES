<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Usuario;
use App\Sintegra;

class CreateDatabaseInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if(!Schema::hasTable(Usuario::TABELA)){
            Schema::create(Usuario::TABELA, function(Blueprint $table){
                $table->increments(Usuario::ID);
                $table->string(Usuario::LOGIN, 50);
                $table->string(Usuario::SENHA, 16);
                $table->timeStamps();
                $table->softDeletes();
                $table->engine = "InnoDB";
            });
        }
        
        if(!Schema::hasTable(Sintegra::TABELA)){
            Schema::create(Sintegra::TABELA, function(Blueprint $table){
                $table->increments(Sintegra::ID);
                $table->integer(Sintegra::USUARIO)->unsigned();
                $table->string(Sintegra::CNPJ, 14);
                $table->json(Sintegra::JSON);
                $table->softDeletes();
                $table->timeStamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Sintegra::TABELA);
        Schema::dropIfExists(Usuario::TABELA);
    }
}
