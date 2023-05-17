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
		Schema::create('personal_access_tokens', function (Blueprint $table) {
			$table->id();
			$table->morphs('tokenable');
			$table->string('name');
			$table->string('token', 64)->unique();
			$table->text('abilities')->nullable();
			$table->date('last_used_at')->nullable();
			$table->date('expires_at')->nullable();
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
		Schema::dropIfExists('personal_access_tokens');
	}
};