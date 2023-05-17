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
		Schema::create('sanpham', function (Blueprint $table) {
			$table->id();
			$table->foreignId('loaisanpham_id')->constrained('loaisanpham');
			$table->foreignId('hangsanxuat_id')->constrained('hangsanxuat');
			$table->string('tensanpham');
			$table->string('tensanpham_slug');
			$table->integer('soluong');
			$table->double('dongia');
			$table->string('hinhanh')->nullable();
			// $table->string('hinhanhkhac')->nullable();
			$table->text('motasanpham')->nullable();
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
		Schema::dropIfExists('sanpham');
	}
};