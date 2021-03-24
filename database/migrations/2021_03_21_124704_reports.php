<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('Rid');
            $table->string('CName');
            $table->text('Logo');
            $table->string('DName');
            $table->mediumInteger('DContact');
            $table->string('PFName');
            $table->text('PLName');
            $table->date('PDOB');
            $table->mediumInteger('PContact');
            $table->longText('Complaint');
            $table->longText('Consultation');
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
        //
    }
}
