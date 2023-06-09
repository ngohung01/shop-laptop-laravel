<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Mail\Mailable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
	
	protected $table = 'users';
	// protected $dates = ['deleted_at'];

	protected $fillable = [
		'name',
		'username',
		'email',
		'password',
		'role',
	];
	
	protected $hidden = [
		'password',
		'remember_token',
	];
	
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
	
	public function DonHang()
	{
		return $this->hasMany(DonHang::class, 'user_id', 'id');
	}
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new CustomResetPasswordNotification($token));
	} 
}
class CustomResetPasswordNotification extends ResetPassword
{
	public function toMail($notifiable)
	{
		$route = '';
		if($notifiable->role == 'user'){
			$route = route('user.datlaimatkhau' ,$this->token, false);
		}else $route = route('password.reset', $this->token, false);
		// dd($route);
		return (new MailMessage)
		->subject('Khôi phục mật khẩu')
		->line('Bạn vừa yêu cầu ' . config('app.name') . ' khôi phục mật khẩu của mình.')
		->line('Xin vui lòng nhấn vào nút "Khôi phục mật khẩu" bên dưới để tiến hành cấp mật khẩu mới.')
		->action('Khôi phục mật khẩu', url(config('app.url') . $route))
		->line('Nếu bạn không yêu cầu đặt lại mật khẩu, xin vui lòng không làm gì thêm và báo lại 
		cho quản trị hệ thống về vấn đề này.');
	} 
}