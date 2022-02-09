<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_keys', function (Blueprint $table) {
            // $table->id();
            $table->uuid("id")->primary()->unique();
            $table->text('title')->nullable();
            $table->string('key')->nullable();
            $table->boolean('type')->default(true);
            $table->string('addedBy')->nullable()->index();
            $table->string('updateBy')->nullable()->index();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('access_keys');
    }
}
