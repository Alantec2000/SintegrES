<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Usuario;
use App\Sintegra;


class CreateDatabaseRelations extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if(Schema::hasTable(Usuario::TABELA) && Schema::hasTable(Sintegra::TABELA)){
            Schema::table(Sintegra::TABELA, function(Blueprint $table){
                $table->foreign(Sintegra::USUARIO)->references(Usuario::ID)->on(Usuario::TABELA);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
