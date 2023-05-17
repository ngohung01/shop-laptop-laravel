<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('username');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->string('role', 20)->default('user');
			$table->date('created_at')->useCurrent(); 
			$table->date('updated_at')->useCurrentOnUpdate();
			$table->engine = 'InnoDB';
		});
		User::create([
			'name'=>'Admin',
			'username'=>'admin',
			'email' => 'admin@gmail.com',
			'password' =>'$2y$10$OZ5YFT7m2IQBEmQyf9B5K.yUER247wUgDi9t0mfnljdDie2Do.GuC',//123456789
			'role'=>'admin',
	]);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
};