<?php

use App\Models\LoaiSanPham;
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
		Schema::create('loaisanpham', function (Blueprint $table) {
			$table->id();
			$table->string('tenloai');
			$table->string('tenloai_slug');
			$table->date('created_at')->useCurrent();
			$table->date('updated_at')->useCurrentOnUpdate();
			$table->engine = 'InnoDB';
		});
		
		// LoaiSanPham::create(['tenloai' => 'Điện thoại', 'tenloai_slug' => 'dien-thoai']);
		// LoaiSanPham::create(['tenloai' => 'Máy tính bảng', 'tenloai_slug' => 'may-tinh-bang']);
		LoaiSanPham::create(['tenloai' => 'Máy tính xách tay', 'tenloai_slug' => 'may-tinh-xach-tay']);
		LoaiSanPham::create(['tenloai' => 'Phụ kiện', 'tenloai_slug' => 'phu-kien']);
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('loaisanpham');
	}
};