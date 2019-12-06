<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_packages', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('pack_id');
            $table->string('pack_name');
            $table->text('pack_description');
            $table->string('pack_type');
            $table->integer('total_credit');
            $table->string('tag_name')->nullable();
            $table->integer('validity_month')->default(0);
            $table->float('pack_price');
            $table->boolean('newbie_first_attend')->default(false);
            $table->integer('newbie_addition_credit');
            $table->string('newbie_note')->nullable();
            $table->string('pack_alias');
            $table->float('estimate_price');
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
        Schema::dropIfExists('class_packages');
    }
}
