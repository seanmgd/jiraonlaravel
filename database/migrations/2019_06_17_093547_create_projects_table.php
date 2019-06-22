<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_id');
            $table->string('title'); 
            $table->text('description'); 
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            //Clef etrangère pour referencer l'owner_id a l'id de la table user, le onDelete cascade permet de supprimer la valeur si l'utilisateur supprime son compte
            //Si il y a une erreur lors du migrate:refresh, c'est parce que la foreign qui est $table->unsignedBigInteger doit bien être lié à l'id du project, si c'est une colonne
            //type Increment, il faut faire unsignedBigInteger, si c'est une bigIncrement, il faut faire unsignedBigInteger
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}