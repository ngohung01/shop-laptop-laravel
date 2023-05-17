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
		Schema::create('donhang', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users');
			$table->foreignId('tinhtrang_id')->constrained('tinhtrang');
			$table->string('dienthoaigiaohang', 20);
			$table->string('diachigiaohang');
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
		Schema::dropIfExists('donhang');
	}
};