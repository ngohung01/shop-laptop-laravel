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
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->id();
            $table->string('tenkhuyenmai');
            $table->string('makhuyenmai');
            $table->integer('giamgia');
            $table->integer('soluong');
            $table->date('ngaybatdau')->useCurrent();
            $table->date('ngayketthuc')->useCurrent();
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
        Schema::dropIfExists('khuyenmai');
    }
};
