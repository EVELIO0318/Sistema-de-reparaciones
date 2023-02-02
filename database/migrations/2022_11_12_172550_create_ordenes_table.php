<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('brand',255);
            $table->tinyInteger('sim',1);
            $table->tinyInteger('charger',1);
            $table->enum('damage',["Sí","No","De Uso"]);
            $table->string('errors',225);
            $table->decimal('price',20,5);
            $table->tinyInteger('status',2);
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
        Schema::dropIfExists('ordenes');
    }
}
