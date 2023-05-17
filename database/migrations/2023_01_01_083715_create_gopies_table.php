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
        Schema::create('gopy', function (Blueprint $table) {
            $table->id();
            $table->string('name');
			$table->string('email');
            $table->string('sodienthoai');
            $table->integer('chude');
            $table->longtext('noidung');
            $table->longtext('phanhoi')->nullable();
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
        Schema::dropIfExists('gopy');
    }
};
