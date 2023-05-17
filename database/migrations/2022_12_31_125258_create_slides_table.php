<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide', function (Blueprint $table) {
            $table->id();
			$table->string('tenslide');
			$table->string('tenslide_slug');
            $table->string('link');
			$table->string('hinhanh')->nullable();
			$table->date('created_at')->useCurrent();
			$table->date('updated_at')->useCurrentOnUpdate();
			$table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slide');
    }
};
