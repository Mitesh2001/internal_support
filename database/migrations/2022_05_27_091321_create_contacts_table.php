<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->nullable();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('work_phone')->nullable();
            $table->bigInteger('mobile_number')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('external_id')->nullable();
            $table->integer('company_id')->default(0);
            $table->text('address')->nullable();
            $table->integer('language_id')->default(0);
            $table->text('about')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
